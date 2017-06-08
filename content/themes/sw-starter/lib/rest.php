<?php // Custom functions to manage RESTful requests to wp-json API.
function wp_json_namespace_v2__init()
{

    // create json-api endpoint

    add_action('rest_api_init', function () {

        // http://example.com/wp-json/namespace/v2/posts?filter[meta_value][month]=12&filter[meta_value][year]=2015

        register_rest_route('wp/v2', '/instagram-posts', array (
            'methods'             => 'GET',
            'callback'            => 'wp_json_instagram_v2__posts',
            'permission_callback' => function (WP_REST_Request $request) {
                return true;
            }
        ));


    });

    // handle the request

    function wp_json_instagram_v2__posts($request)
    {
        
        $parameters = $request->get_query_params();

        // default search args
      
        $args = array(
            'post_type'      => 'instagram-posts',
            'post_status'    => 'publish',
            'posts_per_page' => 21
        );

        // // check the query and add valid items

        if (isset($parameters['filter']['meta_value'])) {
            foreach ($parameters['filter'] as $key => $value) {
                $args[$key] = $value;
            }
        }

        // run query

        $posts = get_posts($args);

        //Get meta for instagram
            if(!empty($posts)){
            $size = 'custom-300x300';

            foreach($posts as $key => &$post) {
                $post_id = $post->ID;
                $instagram_post = new stdClass();
                $instagram_post->link = get_post_meta(  $post->ID , 'instagram_link', true);
                $instagram_post->image = wp_get_attachment_image_url(  get_post_thumbnail_id($post->ID)  , $size );
                $post->meta = $instagram_post;
            }
        }

        $data = array(
            'success' => true,
            'request' => $parameters,
            'count' => count($posts),
            'posts' => $posts,
        );

        return new WP_REST_Response($data, 200);
    }

}

add_action('init', 'wp_json_namespace_v2__init');