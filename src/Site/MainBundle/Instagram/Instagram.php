<?php
/**
 * Created by PhpStorm.
 * User: olegfox
 * Date: 27.03.15
 * Time: 15:51
 */

namespace Site\MainBundle\Instagram;

use Symfony\Component\DependencyInjection\ContainerInterface as Container;


class Instagram implements InstagramInterface
{
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function getMedia($hashtag, $max_id){

        $api = $this->container->get('instaphp');

        if($max_id > 0){
            $response = $api->Tags->Recent($hashtag, array(
                'max_id' => $max_id
            ));
        }else{
            $response = $api->Tags->Recent($hashtag);
        }


        $media = array();
        $i = 0;

        if (empty($response->error)) {
            foreach ($response->data as $item) {
                $media[$i]['link'] = $item['link'];
                $media[$i]['low_image_url'] = $item['images']['low_resolution']['url'];
                $media[$i]['standard_image_url'] = $item['images']['standard_resolution']['url'];
                $media[$i]['thumbnail_url'] = $item['images']['thumbnail']['url'];
                $media[$i]['caption_text'] = empty($item['caption']['text']) ? 'Untitled' : $item['caption']['text'];
                $i++;
            }
            $media['max_id'] = $response->pagination['next_max_id'];
        }

        return $media;
    }
} 