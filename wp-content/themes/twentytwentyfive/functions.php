<?php
/**
 * Twenty Twenty-Five functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Five
 * @since Twenty Twenty-Five 1.0
 */

// Adds theme support for post formats.
if ( ! function_exists( 'twentytwentyfive_post_format_setup' ) ) :
	/**
	 * Adds theme support for post formats.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_post_format_setup() {
		add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );
	}
endif;
add_action( 'after_setup_theme', 'twentytwentyfive_post_format_setup' );

// Enqueues editor-style.css in the editors.
if ( ! function_exists( 'twentytwentyfive_editor_style' ) ) :
	/**
	 * Enqueues editor-style.css in the editors.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_editor_style() {
		add_editor_style( get_parent_theme_file_uri( 'assets/css/editor-style.css' ) );
	}
endif;
add_action( 'after_setup_theme', 'twentytwentyfive_editor_style' );

// Enqueues style.css on the front.
if ( ! function_exists( 'twentytwentyfive_enqueue_styles' ) ) :
	/**
	 * Enqueues style.css on the front.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_enqueue_styles() {
		wp_enqueue_style(
			'twentytwentyfive-style',
			get_parent_theme_file_uri( 'style.css' ),
			array(),
			wp_get_theme()->get( 'Version' )
		);
	}
endif;
add_action( 'wp_enqueue_scripts', 'twentytwentyfive_enqueue_styles' );

// Registers custom block styles.
if ( ! function_exists( 'twentytwentyfive_block_styles' ) ) :
	/**
	 * Registers custom block styles.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_block_styles() {
		register_block_style(
			'core/list',
			array(
				'name'         => 'checkmark-list',
				'label'        => __( 'Checkmark', 'twentytwentyfive' ),
				'inline_style' => '
				ul.is-style-checkmark-list {
					list-style-type: "\2713";
				}

				ul.is-style-checkmark-list li {
					padding-inline-start: 1ch;
				}',
			)
		);
	}
endif;
add_action( 'init', 'twentytwentyfive_block_styles' );

// Registers pattern categories.
if ( ! function_exists( 'twentytwentyfive_pattern_categories' ) ) :
	/**
	 * Registers pattern categories.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_pattern_categories() {

		register_block_pattern_category(
			'twentytwentyfive_page',
			array(
				'label'       => __( 'Pages', 'twentytwentyfive' ),
				'description' => __( 'A collection of full page layouts.', 'twentytwentyfive' ),
			)
		);

		register_block_pattern_category(
			'twentytwentyfive_post-format',
			array(
				'label'       => __( 'Post formats', 'twentytwentyfive' ),
				'description' => __( 'A collection of post format patterns.', 'twentytwentyfive' ),
			)
		);
	}
endif;
add_action( 'init', 'twentytwentyfive_pattern_categories' );

// Registers block binding sources.
if ( ! function_exists( 'twentytwentyfive_register_block_bindings' ) ) :
	/**
	 * Registers the post format block binding source.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_register_block_bindings() {
		register_block_bindings_source(
			'twentytwentyfive/format',
			array(
				'label'              => _x( 'Post format name', 'Label for the block binding placeholder in the editor', 'twentytwentyfive' ),
				'get_value_callback' => 'twentytwentyfive_format_binding',
			)
		);
	}
endif;
add_action( 'init', 'twentytwentyfive_register_block_bindings' );

// Registers block binding callback function for the post format name.
if ( ! function_exists( 'twentytwentyfive_format_binding' ) ) :
	/**
	 * Callback function for the post format name block binding source.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return string|void Post format name, or nothing if the format is 'standard'.
	 */
	function twentytwentyfive_format_binding() {
		$post_format_slug = get_post_format();

		if ( $post_format_slug && 'standard' !== $post_format_slug ) {
			return get_post_format_string( $post_format_slug );
		}
	}
endif;

// Register custom post type 'projects'
function register_projects_post_type() {
    $labels = [
        'name'               => _x('Projects', 'post type general name'),
        'singular_name'      => _x('Project', 'post type singular name'),
        'menu_name'          => _x('Projects', 'admin menu'),
        'name_admin_bar'     => _x('Project', 'add new on admin bar'),
        'add_new'            => _x('Add New', 'project'),
        'add_new_item'       => __('Add New Project'),
        'new_item'           => __('New Project'),
        'edit_item'          => __('Edit Project'),
        'view_item'          => __('View Project'),
        'all_items'          => __('All Projects'),
        'search_items'       => __('Search Projects'),
        'parent_item_colon'  => __('Parent Projects:'),
        'not_found'          => __('No projects found.'),
        'not_found_in_trash' => __('No projects found in Trash.')
    ];

    $args = [
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => ['slug' => 'projects', 'with_front' => false],
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => ['title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments']
    ];

    register_post_type('projects', $args);
}

add_action('init', 'register_projects_post_type');

// Register custom taxonomy 'Project Type'
function register_project_type_taxonomy() {
    $labels = [
        'name'              => _x('Project Types', 'taxonomy general name'),
        'singular_name'     => _x('Project Type', 'taxonomy singular name'),
        'search_items'      => __('Search Project Types'),
        'all_items'         => __('All Project Types'),
        'parent_item'       => __('Parent Project Type'),
        'parent_item_colon' => __('Parent Project Type:'),
        'edit_item'         => __('Edit Project Type'),
        'update_item'       => __('Update Project Type'),
        'add_new_item'      => __('Add New Project Type'),
        'new_item_name'     => __('New Project Type Name'),
        'menu_name'         => __('Project Type'),
    ];

    $args = [
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => ['slug' => 'project-type'],
    ];

    register_taxonomy('project_type', ['projects'], $args);
}

add_action('init', 'register_project_type_taxonomy');

// Flush rewrite rules on theme activation
function flush_rewrite_rules_on_theme_activation() {
    register_projects_post_type();
    register_project_type_taxonomy();
    flush_rewrite_rules();
}

add_action('after_switch_theme', 'flush_rewrite_rules_on_theme_activation');

// Create archive page for Projects with pagination
function projects_archive_template($template) {
    if (is_post_type_archive('projects')) {
        $theme_files = ['archive-projects.php', 'archive.php'];
        $exists_in_theme = locate_template($theme_files, false);
        if ($exists_in_theme) {
            return $exists_in_theme;
        }
    }
    return $template;
}

add_filter('archive_template', 'projects_archive_template');

// Register Ajax endpoint for fetching Projects
function fetch_architecture_projects() {
    $posts_per_page = is_user_logged_in() ? 6 : 3;
    $args = [
        'post_type'      => 'projects',
        'posts_per_page' => $posts_per_page,
        'tax_query'      => [
            [
                'taxonomy' => 'project_type',
                'field'    => 'slug',
                'terms'    => 'architecture',
            ],
        ],
    ];

    $query = new WP_Query($args);
    $projects = [];

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $projects[] = [
                'id'    => get_the_ID(),
                'title' => get_the_title(),
                'link'  => get_permalink(),
            ];
        }
    }

    wp_send_json_success(['data' => $projects]);
}

add_action('wp_ajax_nopriv_fetch_architecture_projects', 'fetch_architecture_projects');
add_action('wp_ajax_fetch_architecture_projects', 'fetch_architecture_projects');

// Modify the query for the projects archive page to limit the number of projects per page to 6 and filter by 'Architecture' project type
function set_projects_posts_per_page($query) {
    if ($query->is_post_type_archive('projects') && $query->is_main_query()) {
        $query->set('posts_per_page', 6);
        // $query->set('tax_query', [
        //     [
        //         'taxonomy' => 'project_type',
        //         'field'    => 'slug',
        //         'terms'    => 'architecture',
        //     ],
        // ]);
    }
}

add_action('pre_get_posts', 'set_projects_posts_per_page');

// Enqueue the JavaScript File
function enqueue_ajax_script() {
    wp_enqueue_script('ajax-script', get_template_directory_uri() . '/js/ajax-script.js', array('jquery'), null, true);
    wp_localize_script('ajax-script', 'ajax_params', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_ajax_script');

// Shortcode to test projects for logged-in and logged-out users
function test_projects_shortcode() {
    ob_start();
    ?>
    <div id="test-projects-shortcode">
        <h2>Fetch Architecture Projects</h2>
        <button id="fetch-projects">Fetch Projects</button>
        <div id="projects-result"></div>
    </div>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('#fetch-projects').on('click', function() {
                $.ajax({
                    url: ajax_params.ajax_url,
                    type: 'GET',
                    data: {
                        action: 'fetch_architecture_projects'
                    },
                    success: function(response) {
                        console.log(response); // Log the response to inspect it
                        if (response.success) {
                            var projects = response.data; // Access the correct data property
                            if (Array.isArray(projects)) {
                                var output = '<ul>';
                                projects.forEach(function(project) {
                                    output += '<li><a href="' + project.link + '">' + project.title + '</a></li>';
                                });
                                output += '</ul>';
                                $('#projects-result').html(output);
                            } else {
                                $('#projects-result').html('<p>Unexpected response format.</p>');
                            }
                        } else {
                            $('#projects-result').html('<p>No projects found.</p>');
                        }
                    },
                    error: function() {
                        $('#projects-result').html('<p>An error occurred.</p>');
                    }
                });
            });
        });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('test_projects', 'test_projects_shortcode');

// Function to fetch a random coffee image
function hs_give_me_coffee() {
    $response = wp_remote_get('https://coffee.alexflipnote.dev/random.json');
    if (is_wp_error($response)) {
        return 'Could not retrieve coffee image.';
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);

    if (isset($data['file'])) {
        return $data['file'];
    }

    return 'No coffee image found.';
}

// Shortcode to display Kanye West quotes
function display_kanye_quotes() {
    $quotes = [];
    for ($i = 0; $i < 5; $i++) {
        $response = wp_remote_get('https://api.kanye.rest/');
        if (!is_wp_error($response)) {
            $body = wp_remote_retrieve_body($response);
            $data = json_decode($body, true);
            if (isset($data['quote'])) {
                $quotes[] = $data['quote'];
            }
        }
    }

    ob_start();
    ?>
    <div id="kanye-quotes">
        <h2>Kanye West Quotes</h2>
        <ul>
            <?php foreach ($quotes as $quote): ?>
                <li><?php echo esc_html($quote); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('kanye_quotes', 'display_kanye_quotes');

// Shortcode to display a random coffee image
function display_random_coffee() {
    $coffee_image = hs_give_me_coffee();
    ob_start();
    ?>
    <div id="random-coffee">
        <h2>Here is your coffee!</h2>
        <img src="<?php echo esc_url($coffee_image); ?>" alt="Random Coffee">
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('random_coffee', 'display_random_coffee');


