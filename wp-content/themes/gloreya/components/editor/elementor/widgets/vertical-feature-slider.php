<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Gloreya_Vertical_Features_Slider_Widget extends Widget_Base {

  public $base;

    public function get_name() {
        return 'gloreya-vertical-feature-slider';
    }

    public function get_title() {
        return esc_html__( 'Post vertical feature slider', 'gloreya' );
    }

    public function get_icon() { 
        return 'eicon-nav-menu';
    }

    public function get_categories() {
        return [ 'gloreya-elements' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_tab',
            [
                'label' => esc_html__('Post', 'gloreya'),
            ]
        );
    
        $this->add_control(
          'post_count',
          [
            'label'         => esc_html__( 'Post count', 'gloreya' ),
            'type'          => Controls_Manager::NUMBER,
            'default'       => 5,
          ]
        );
      
        $this->add_control(
          'post_title_crop',
          [
            'label'         => esc_html__( 'Post title crop', 'gloreya' ),
            'type'          => Controls_Manager::NUMBER,
            'default'       => '10',
          ]
        );
    
        $this->add_control(
            'post_format',
            [
                'label' =>esc_html__('Select Post Format', 'gloreya'),
                'type'      => Controls_Manager::SELECT2,
                'options' => [
					'standard'  =>esc_html__( 'Standard', 'gloreya' ),
					'video' =>esc_html__( 'Video', 'gloreya' ),
				],
				'default' => [],
                'label_block' => true,
                'multiple'  => true,
            ]
        );
        $this->add_control(
            'post_cats',
            [
                'label' =>esc_html__('Select Categories', 'gloreya'),
                'type'      => Controls_Manager::SELECT2,
                'options'   => $this->post_category(),
                'label_block' => true,
                'multiple'  => true,
            ]
        );

      $this->add_control(
         'delicios_slider_autoplay',
             [
             'label' => esc_html__( 'Autoplay', 'gloreya' ),
             'type' => \Elementor\Controls_Manager::SWITCHER,
             'label_on' => esc_html__( 'Yes', 'gloreya' ),
             'label_off' => esc_html__( 'No', 'gloreya' ),
             'return_value' => 'yes',
             'default' => 'no'
             ]
         );
 
         $this->add_control(
         'delicios_slider_nav_show',
             [
             'label' => esc_html__( 'Nav show', 'gloreya' ),
             'type' => \Elementor\Controls_Manager::SWITCHER,
             'label_on' => esc_html__( 'Yes', 'gloreya' ),
             'label_off' => esc_html__( 'No', 'gloreya' ),
             'return_value' => 'yes',
             'default' => 'yes'
             ]
         );



        $this->add_control(
            'show_cat',
            [
                'label' => esc_html__('Show Category', 'gloreya'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'gloreya'),
                'label_off' => esc_html__('No', 'gloreya'),
                'default' => 'no',
            ]
        );
        $this->add_control(
            'show_rating',
            [
                'label' => esc_html__('Show Rating', 'gloreya'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'gloreya'),
                'label_off' => esc_html__('No', 'gloreya'),
                'default' => 'no',
            ]
        );
      
        $this->add_control(
            'post_sortby',
            [
                'label'     =>esc_html__( 'Post sort by', 'gloreya' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'latestpost',
                'options'   => [
                        'latestpost'      =>esc_html__( 'Latest posts', 'gloreya' ),
                        'popularposts'    =>esc_html__( 'Popular posts', 'gloreya' ),
                        'mostdiscussed'    =>esc_html__( 'Most discussed', 'gloreya' ),
                    ],
            ]
        );
        
        $this->add_control(
            'post_order',
            [
                'label'     =>esc_html__( 'Post order', 'gloreya' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'DESC',
                'options'   => [
                        'DESC'      =>esc_html__( 'Descending', 'gloreya' ),
                        'ASC'       =>esc_html__( 'Ascending', 'gloreya' ),
                    ],
            ]
        );

    
      $this->add_responsive_control(
        'post_margin',
        [
            'label' => esc_html__('Post Margin', 'gloreya' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px','%'],
            'selectors' => [
                '{{WRAPPER}} .vertical-post-grid .item.ts-overlay-style' => 'Margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                '{{WRAPPER}} .vertical-grid-style .post-block-style' => 'Margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
      $this->add_responsive_control(
        'feature_content_padding',
        [
            'label' => esc_html__('Feature Content Padding', 'gloreya' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px','%'],
            'selectors' => [
                '{{WRAPPER}} .verticale-feature-post .col-lg-6.slide-item .post-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                '{{WRAPPER}} .verticale-feature-post .col-lg-12.slide-item .post-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
      $this->add_responsive_control(
        'post_content_padding',
        [
            'label' => esc_html__('Post Content Padding', 'gloreya' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px','%'],
            'selectors' => [
                '{{WRAPPER}} .ts-overlay-style .post-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $this->add_control(
      'ts_offset_enable',
         [
            'label' => esc_html__('Post skip', 'gloreya'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Yes', 'gloreya'),
            'label_off' => esc_html__('No', 'gloreya'),
            'default' => 'no',
            
         ]
   );
      $this->add_control(
         'ts_offset_item_num',
         [
         'label'         => esc_html__( 'Skip post count', 'gloreya' ),
         'type'          => Controls_Manager::NUMBER,
         'default'       => '1',
         'condition' => [ 'ts_offset_enable' => 'yes' ]

         ]
      );

        $this->add_responsive_control(
         'thumbnail_height',
         [
            'label' =>esc_html__( 'Thumbnail height', 'gloreya' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => [
               'px' => [
                  'min' => 0,
                  'max' => 1000,
               ],
            ],
            'devices' => [ 'desktop', 'tablet', 'mobile' ],
            'desktop_default' => [
               'size' => 120,
               'unit' => 'px',
            ],
            'tablet_default' => [
               'size' => 300,
               'unit' => 'px',
            ],
            'mobile_default' => [
               'size' => 250,
               'unit' => 'px',
            ],
            'selectors' => [
               '{{WRAPPER}} .item' => 'min-height: {{SIZE}}{{UNIT}};',
            ],
         ]
       );
    
   

        $this->end_controls_section();

        $this->start_controls_section('gloreya_style_block_section',
        [
           'label' => esc_html__( ' Post', 'gloreya' ),
           'tab' => Controls_Manager::TAB_STYLE,
        ]
       );
  
       $this->add_control(
           'block_title_color',
           [
              'label' => esc_html__('Title color', 'gloreya'),
              'type' => Controls_Manager::COLOR,
              'default' => '',
            
              'selectors' => [
                 '{{WRAPPER}} .post-content .post-title a' => 'color: {{VALUE}};',
              ],
           ]
        );
  
        $this->add_control(
           'block_title_hv_color',
           [
              'label' => esc_html__('Title hover color', 'gloreya'),
              'type' => Controls_Manager::COLOR,
              'default' => '',
            
              'selectors' => [
                 '{{WRAPPER}} .post-content .post-title:hover a' => 'color: {{VALUE}};',
              ],
           ]
        );
  
        $this->add_group_control(
           Group_Control_Typography::get_type(),
           [
              'name' => 'post_feature_title_typography',
              'label' => esc_html__( 'Feature Title Typography', 'gloreya' ),
              'selector' => '{{WRAPPER}} .verticale-feature-post .col-lg-6.slide-item .post-content .post-title,
                     {{WRAPPER}} .verticale-feature-post .col-lg-12.slide-item .post-content .post-title',
           ]
        );

        $this->add_group_control(
           Group_Control_Typography::get_type(),
           [
              'name' => 'post_title_typography',
              'label' => esc_html__( 'Typography', 'gloreya' ),
              'selector' => '{{WRAPPER}} .post-content .post-title',
           ]
        );
  
        $this->add_responsive_control(
         'title_margin',
               [
                  'label' => esc_html__('Title Margin', 'gloreya' ),
                  'type' => Controls_Manager::DIMENSIONS,
                  'size_units' => [ 'px','%'],
                  'selectors' => [
                     '{{WRAPPER}} .ts-overlay-style .post-title' => 'Margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                  ],
               ]
         );

        $this->add_control(
           'block_meta_date_color',
           [
              'label' => esc_html__('Meta color', 'gloreya'),
              'type' => Controls_Manager::COLOR,
              'default' => '',
            
              'selectors' => [
                 '{{WRAPPER}} .ts-overlay-style .post-meta-info li a' => 'color: {{VALUE}};',
                 '{{WRAPPER}} .ts-overlay-style .post-meta-info li:before' => 'background-color: {{VALUE}};',
               
              ],
           ]
        );
        $this->add_control(
           'rating_bar_color',
           [
              'label' => esc_html__('Rating bar color', 'gloreya'),
              'type' => Controls_Manager::COLOR,
              'default' => '',
              'condition' => ['show_rating' => 'yes'],
            
           ]
        );


  
        $this->end_controls_section();
    }

    protected function render( ) { 
        $settings = $this->get_settings();
        $post_order         = $settings['post_order'];
        $post_sortby        = $settings['post_sortby'];
        $show_cat           = $settings['show_cat'];
        $post_format        = $settings['post_format'];
        $post_title_crop    = $settings['post_title_crop'];
        $post_number        = $settings['post_count'];
        $auto_nav_slide     =  $settings['delicios_slider_autoplay'];
        $show_navigation    =   $settings["delicios_slider_nav_show"]=="yes"?true:false;
        
        $arg = [
            'post_type'   =>  'post',
            'post_status' => 'publish',
            'order' => $settings['post_order'],
            'posts_per_page' => $settings['post_count'],
            'category__in' => $settings['post_cats'],

        ];

        if($settings['ts_offset_enable']=='yes'){
         $arg['offset'] = $settings['ts_offset_item_num'];
       }


        if(in_array('video',$post_format) && !in_array('standard',$post_format)) {

         $arg['tax_query'] = array(
                  array(
                  'taxonomy' => 'post_format',
                  'field' => 'slug',
                  'terms' => array('post-format-video'),
                  'operator' => 'IN'
               ) 
           );

       } 

        switch($settings['post_sortby']){
         case 'popularposts':
             $arg['orderby'] = 'meta_value_num';
         break;
         case 'mostdiscussed':
             $arg['orderby'] = 'comment_count';
         break;
         default:
             $arg['orderby'] = 'date';
         break;
     }

     $slide_controls    = [
      'show_nav'=>$show_navigation, 
      'auto_nav_slide'=>$auto_nav_slide, 
   ];

        $slide_controls = \json_encode($slide_controls); 
        
        $query = \get_posts( $arg ); 
       
        ?>
            <div class="vertical-post-grid ">
                <div class="verticale-feature-post owl-carousel" data-controls="<?php echo esc_attr($slide_controls); ?>">
                <?php foreach (array_chunk($query, 3) as $key => $value): ?>
                        <?php  require 'style/content-style4.php'; ?>
                    <?php endforeach; ?>
                </div>
            </div><!-- block-item6 -->
            <?php wp_reset_postdata(); ?>

      <?php  
    }
    protected function content_template() { }

    public function post_category() {

      $terms = get_terms( array(
            'taxonomy'    => 'category',
            'hide_empty'  => false,
            'posts_per_page' => -1, 
      ) );

      $cat_list = [];
      foreach($terms as $post) {
      $cat_list[$post->term_id]  = [$post->name];
      }
      return $cat_list;
   }
}
