<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;


class Gloreya_chef_Widget extends Widget_Base {


    public $base;

    public function get_name() {
        return 'gloreya-chef';
    }

    public function get_title() {
        return esc_html__( 'Gloreya chef', 'gloreya' );
    }

    public function get_icon() { 
        return 'eicon-lock-user';
    }

    public function get_categories() {
        return [ 'gloreya-elements' ];
    }

    protected function register_controls() {

      $this->start_controls_section(
         'section_tab',
         [
             'label' => esc_html__('Chef settings', 'gloreya'),
         ]
      );

      $this->add_control(
         'chef_style',
         [
            'label' => esc_html__( 'Chef style', 'gloreya' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'style1',
            'options' => [
               'style1'  => esc_html__( 'Style 1', 'gloreya' ),
               'style2' =>  esc_html__( 'Style 2', 'gloreya' ),
               'style3' =>  esc_html__( 'Style 3', 'gloreya' ),
               'style4' =>  esc_html__( 'Style 4', 'gloreya' ),
           
            ],
         ]
      );

      $this->add_control('chef_member',
         [
            'label'     => esc_html__( 'Select chef member', 'gloreya' ),
            'type'      => \Elementor\Controls_Manager::SELECT2,
            'multiple' => false,
            'options'   => $this->getChef(),
         
         ]
      ); 


      $this->add_control(
         'show_title',
         [
             'label'     => esc_html__('Show name', 'gloreya'),
             'type' => \Elementor\Controls_Manager::SELECT,
             'default' => 'block',
             'options' => [
                'block'  => esc_html__( 'Show', 'gloreya' ),
                'none'   => esc_html__( 'Hide', 'gloreya' ),
             ],
            'selectors' => [
                '{{WRAPPER}} .chef-area .team-details .team-name' => 'display: {{VALUE}};',
             ],
            
         ]
      );
  
      $this->add_control(
         'show_designation',
         [
             'label'     => esc_html__('Show designation', 'gloreya'),
             'type' => \Elementor\Controls_Manager::SELECT,
             'default' => 'block',
             'options' => [
                'block'  => esc_html__( 'Show', 'gloreya' ),
                'none'   => esc_html__( 'Hide', 'gloreya' ),
             ],
            'selectors' => [
                '{{WRAPPER}} .chef-area .team-details .team-designation' => 'display: {{VALUE}};',
             ],
            
         ]
      );

      $this->add_control(
         'show_social',
         [
             'label'     => esc_html__('Show social', 'gloreya'),
             'type' => \Elementor\Controls_Manager::SELECT,
             'default' => 'block',
             'options' => [
                'block'  => esc_html__( 'Show', 'gloreya' ),
                'none'   => esc_html__( 'Hide', 'gloreya' ),
             ],
            'selectors' => [
                '{{WRAPPER}} .chef-area .team-content .social-postion' => 'display: {{VALUE}};',
             ],
            
         ]
      );
      
      $this->add_responsive_control(
			'content_align', [
				'label'			 => esc_html__( 'Text alignment', 'gloreya' ),
				'type'			 => Controls_Manager::CHOOSE,
				'options'		 => [

               'left'		 => [
                  
                  'title'	 => esc_html__( 'Left', 'gloreya' ),
						'icon'	 => 'fa fa-align-left',
               
               ],
					'center'	     => [
                  
                  'title'	 => esc_html__( 'Center', 'gloreya' ),
						'icon'	 => 'fa fa-align-center',
               
               ],
					'right'		 => [

						'title'	 => esc_html__( 'Right', 'gloreya' ),
                  'icon'	 => 'fa fa-align-right',
                  
					],
					'justify'	 => [

						'title'	 => esc_html__( 'Justified', 'gloreya' ),
                  'icon'	 => 'fa fa-align-justify',
                  
					],
				],
            'default'		 => 'center',
            'selectors' => [
               '{{WRAPPER}} .chef-area' => 'text-align: {{VALUE}};',
                          
                
            ],
          
			]
        );//Responsive control end

      $this->end_controls_section();

         //Title Style Section
		$this->start_controls_section(
			'section_title', [
				'label'	 => esc_html__( 'Title', 'gloreya' ),
				'tab'	    => Controls_Manager::TAB_STYLE,
			  ]
      );  

      $this->add_control(
			'title_color', [

				'label'		 => esc_html__( 'Title color', 'gloreya' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
               '{{WRAPPER}} .chef-area .team-details .team-name' => 'color: {{VALUE}};',
               
				],
			]
      );
      $this->add_control(
			'title_hover_color', [

				'label'		 => esc_html__( 'Title hover color', 'gloreya' ),
            'type'		 => Controls_Manager::COLOR,
            'condition' => ['chef_style' => ['style4']],
				'selectors'	 => [
               '{{WRAPPER}} .chef-area:hover .team-details .team-name' => 'color: {{VALUE}};',
               
				],
			]
      );

      $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'name_typography',
				'label' => esc_html__( 'Name typography', 'gloreya' ),
            'selector' => '{{WRAPPER}} .chef-area .team-details .team-name',
			]
      );


      $this->end_controls_section();

      $this->start_controls_section(
			'section_designation', [
				'label'	 => esc_html__( 'Designation', 'gloreya' ),
				'tab'	    => Controls_Manager::TAB_STYLE,
			  ]
      ); 
  
      $this->add_control(
         'designation_color', [
         'label'		 => esc_html__( 'Designation color', 'gloreya' ),
         'type'		 => Controls_Manager::COLOR,
         'selectors'	 => [
           '{{WRAPPER}} .chef-area .team-details .team-designation' => 'color: {{VALUE}};',
         ],
      ]
      );

      $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'designation_typography',
				'label' => esc_html__( 'Designation typography', 'gloreya' ),
            'selector' => '{{WRAPPER}} .chef-area .team-details .team-designation',
			]
      );


      $this->end_controls_section();
       
		$this->start_controls_section(
			'section_style', [
				'label'	 => esc_html__( 'Social', 'gloreya' ),
				'tab'	    => Controls_Manager::TAB_STYLE,
			  ]
      );

      
    
      $this->add_control(
         'social_color', [
   
            'label'		 => esc_html__( 'Social color', 'gloreya' ),
            'type'		 => Controls_Manager::COLOR,
            'selectors'	 => [
   
               '{{WRAPPER}} .chef-area .social-postion li a i' => 'color: {{VALUE}};',
              
               
            ],
          ]
     );

     $this->add_responsive_control(
      'social_margin',
      [
         'label' => esc_html__( 'Social Margin', 'gloreya' ),
         'type' => Controls_Manager::DIMENSIONS,
         'size_units' => [ 'px', '%', 'em' ],
         'selectors' => [
            '{{WRAPPER}} .chef-area .social-postion' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
         ],
      ]
     );
   
      $this->end_controls_section();

      $this->start_controls_section(
			'section_image', [
				'label'	 => esc_html__( 'Image', 'gloreya' ),
            'tab'	    => Controls_Manager::TAB_STYLE,
            'condition' => ['chef_style' => ['style4']],
			  ]
      );
      $this->add_control(
         'image_bg', [
   
            'label'		 => esc_html__( 'Image Background color', 'gloreya' ),
            'type'		 => Controls_Manager::COLOR,
            'selectors'	 => [
   
               '{{WRAPPER}} .ts-team-style4 .ts-team-info .chef-shape-img > path' => 'fill: {{VALUE}};',
              
               
            ],
          ]
     );
      $this->add_control(
         'image_hover_bg', [
   
            'label'		 => esc_html__( 'Image Hover Background color', 'gloreya' ),
            'type'		 => Controls_Manager::COLOR,
            'selectors'	 => [
   
               '{{WRAPPER}} .ts-team-style4 .ts-team-info:hover .chef-shape-img > path' => 'fill: {{VALUE}};',
              
               
            ],
          ]
     );

      $this->end_controls_section();

      $this->start_controls_section(
			'section_advanced_postion', [
				'label'	 => esc_html__( 'Advanced Style', 'gloreya' ),
				'tab'	    => Controls_Manager::TAB_STYLE,
			  ]
      );
      
      
      $this->add_control(
			'more_options',
			[
				'label' => esc_html__( 'Chef info', 'gloreya' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
      );
      
      $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
            'label' => esc_html__( 'Chef Content Border', 'gloreya' ),
            'show_label' => true,
            'label_block' => true,
				'selector' => '{{WRAPPER}} .chef-area .team-content',
			]
      );
      
      $this->add_control(
         'cnt-wrapper_hover_color', [
   
            'label'		 => esc_html__( 'Content hover bgcolor', 'gloreya' ),
            'type'		 => Controls_Manager::COLOR,
            'selectors'	 => [
                  '{{WRAPPER}} .chef-area .team-content:hover' => 'background: {{VALUE}};',
            ],
            'condition' => [
               'chef_style' => ['style3']
            ]
         ]
      );

      $this->add_control(
         'cnt-wrapper_bg_color', [
   
            'label'		 => esc_html__( 'Content bgcolor', 'gloreya' ),
            'type'		 => Controls_Manager::COLOR,
            'selectors'	 => [
                  '{{WRAPPER}} .chef-area .team-content' => 'background: {{VALUE}};',
                  '{{WRAPPER}} .ts-team-style4 .ts-team-info' => 'background: {{VALUE}};',
            ],
         ]
      );

      $this->add_control(
			'chef_content_options',
			[
				'label' => esc_html__( 'Chef border', 'gloreya' ),
				'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
            
			]
      );
      
      $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'chef_content_border',
            'label' => esc_html__( 'Chef Border', 'gloreya' ),
            'show_label' => true,
            'label_block' => true,
            'selector' => '{{WRAPPER}} .chef-area .ts-team-info',
            
			]
      );

      $this->end_controls_section();

    }

    protected function render( ) { 

      $settings         = $this->get_settings();
      $chef_member_id   = $settings['chef_member'];
      $chef_style     = $settings['chef_style'];
      $ts_team_class = 'ts-team';
      $chef         = get_post($chef_member_id);
      $image_url    = wp_get_attachment_url( get_post_thumbnail_id($chef->ID), 'full' );
      $designation  = gloreya_meta_option($chef->ID,'member_designation',''); 
      $socials      = gloreya_meta_option($chef->ID,'member_social',[]); 

      if($chef_style == 'style1'):
         $ts_team_class = 'ts-team';   
      elseif($chef_style == 'style2'):
         $ts_team_class = 'ts-team-classic';   
      elseif($chef_style == 'style3'):
         $ts_team_class = 'ts-team-standard';
      elseif($chef_style == 'style4'):
         $ts_team_class = 'ts-team-style4';
      endif;         

        
      ?>
    
         <div class="<?php echo esc_attr($ts_team_class); ?> chef-area">
            <div class="ts-team-info">
               <?php if($image_url!=''): ?>
                     <?php if($chef_style == 'style4'){ ?>
                        <div class="chef-image">
                           <img class="chef-shape-img" src="<?php echo esc_url( GLOREYA_IMG.'/image_shape.svg'); ?>" alt="<?php echo esc_attr($chef->post_title); ?>">
                           <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($chef->post_title); ?>" class="img-fluid">

                        </div>
                     <?php }else{ ?>

                     <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($chef->post_title); ?>" class="img-fluid">
                     
                   <?php } ?>

               <?php endif; ?>
               <div class="team-content">
                  <div class="team-details">
                     <span class="team-name">
                        <?php echo esc_html($chef->post_title); ?>
                     </span>
                     <p class='team-designation'> <?php echo esc_html($designation); ?> </p>
                  </div>
                  <ul class="team-social unstyled social-postion">
                    <?php foreach($socials as $social): ?> 
                        <?php 
                              $icon_cls = $social['social_icon'];
                              $icon_class = explode('-', $icon_cls);
                          ?>
                      <li class="<?php echo esc_attr(isset($icon_class[1]) ? $icon_class[1] : ''); ?>">
                         <a href="<?php echo esc_url($social['social_url']); ?>">
                           <i class="<?php echo esc_attr($social['social_icon']); ?>">
                           </i>
                         </a>
                      </li>
                    <?php endforeach; ?>
                  </ul>
               </div> <!-- Post Body End -->
            </div>
         </div>

     
      <?php
    
    }
    
    protected function content_template() { }

    public function getChef(){
      
      $chef_list = [];

      $args = array(
         'numberposts'      => -1,
         'orderby'          => 'post_date',
         'order'            => 'DESC',
         'post_type'        => 'ts-chef',
         'post_status'      => 'publish',
        
      );

      $chefs = get_posts($args);
 
      if($chefs):
       // Loop the posts
         foreach ($chefs as $chef):
           $chef_list[$chef->ID]= $chef->post_title; 
         endforeach;
      endif;
      return $chef_list;

  }
}