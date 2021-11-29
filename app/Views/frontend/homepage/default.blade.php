@include('frontend.components.header')
<?php
enqueue_style('home-slider');
enqueue_script('home-slider');

enqueue_style('mapbox-gl-css');
enqueue_style('mapbox-gl-geocoder-css');
enqueue_script('mapbox-gl-js');
enqueue_script('mapbox-gl-geocoder-js');

enqueue_style('daterangepicker-css');
enqueue_script('daterangepicker-js');
enqueue_script('daterangepicker-lang-js');

enqueue_style('iconrange-slider');
enqueue_script('iconrange-slider');

enqueue_script('owl-carousel');
enqueue_style('owl-carousel');
enqueue_style('owl-carousel-theme');

$tab_services = get_option('sort_search_form', convert_tab_service_to_list_item());
?>
<div class="home-page pb-5">
    @if(!empty($tab_services))
        <div class="hh-search-form-wrapper">
            <div class="ots-slider-wrapper" data-style="full-screen" data-slider="ots-slider">
                <div class="ots-slider">
                    <?php
                    $sliders = get_option('home_slider');
                    $sliders = explode(',', $sliders);
                    ?>
                    @if(!empty($sliders) && is_array($sliders))
                        @foreach($sliders as $id)
                            <?php
                            $url = get_attachment_url($id);
                            ?>
                            <div class="item">
                                <div class="outer has-background-image" data-src="{{ $url }}"
                                     style="background-image: url('{{ $url }}')"></div>
                                <div class="inner">
                                    <div class="img has-background-image" data-src="{{ $url }}"
                                         style="background-image: url('{{ $url }}');"></div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="hh-search-form-section">
                <div class="container">
                    <div class="hh-search-form">
                        @if(!empty($tab_services))
                          
                            <div class="tab-content  @if(count($tab_services) == 1) pt-0 @endif">
                                @foreach($tab_services as $key => $item)
                                    <div class="tab-pane {{$key == 0 ? 'active' : ''}}" id="tab-search-{{$item['id']}}">
                                        <?php
                                        start_get_view();
                                        if(View::exists('frontend.' . 'Car' . '.search.search-form')){
                                        ?>
                                        @include('frontend.'. 'Car' .'.search.search-form')
                                        <?php }
                                        $content = end_get_view();
                                        echo apply_filters('hh_tab_services_html', $content, $item);
                                        ?>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="container">
        @if(!empty($tab_services))
            <h2 class="h3 mt-5 mb-3">{{__('Explore superior car rental')}}</h2>
            <div class="list-of-featured-services">
                <div class="row">
                    <?php
                    foreach($tab_services as $service){
                    if (isset($service['only_search_form']) && $service['only_search_form']) {
                        continue;
                    }
                    $featured_image = get_option($service['id'] . '_featured_image');
                    $image_url = get_attachment_url($featured_image, 'full');
                    $func = 'get_' . $service['id'] . '_search_page';
                    $search_url = function_exists($func) ? $func() : url('/');
                    ?>
                    <div class="col-4">
                        <div class="item">
                            <a href="{{$search_url}}" target="_blank">
                                <div class="row">
                                    <div class="col-12 col-md-5">
                                        <div class="thumbnail">
                                            <div class="thumbnail-outer">
                                                <div class="thumbnail-inner">
                                                    <img src="{{ $image_url }}"
                                                         alt="{{ get_translate($service['label']) }}"
                                                         class="img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-7 d-md-flex align-items-center">
                                        <h2 class="title">{{ get_translate($service['label']) }}</h2>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        @endif
    <!-- Home in New York -->
       
    <!-- Destination -->
        <?php
        $locations = get_option('top_destination');
        ?>
      
    <!-- Experience Types -->
        <?php
        $experience_types = get_terms('experience-type', true);
        ?>
       
    <!-- Experience in Ha Noi -->
       
    </div>

    <!-- Call to action -->
    <?php
    $page_id = get_option('call_to_action_page');
    $cta_background_id = get_option('call_to_action_background', '');
    ?>
    
    <div class="container">
        <!--Featured Car -->
        @if(is_enable_service('car'))
            <?php
            $list_services = \App\Controllers\Services\CarController::get_inst()->listOfCars([
                'number' => 8,
                'is_featured' => 'on'
            ]);
            ?>
            @if(count($list_services['results']))
                <h2 class="h3 mt-4">{{__('Featured Cars')}}</h2>
                <p>{{__('Book incredible things to do around the world.')}}</p>
                <div class="hh-list-of-services">
                    <?php
                    $responsive = [
                        0 => [
                            'items' => 1
                        ],
                        768 => [
                            'items' => 2
                        ],
                        992 => [
                            'items' => 3
                        ],
                        1200 => [
                            'items' => 4
                        ],
                    ];
                    ?>
                    <div class="hh-carousel carousel-padding nav-style2"
                         data-responsive="{{ base64_encode(json_encode($responsive)) }}" data-margin="15" data-loop="0">
                        <div class="owl-carousel">
                            @foreach($list_services['results'] as $item)
                                <div class="item">
                                    @include('frontend.car.loop.grid', [
                                                    'item' => $item
                                                ])
                                </div>
                            @endforeach
                        </div>
                        <div class="owl-nav">
                            <a href="javascript:void(0)"
                               class="prev"><i class="ti-angle-left"></i></a>
                            <a href="javascript:void(0)"
                               class="next"><i class="ti-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    </div>
    <!-- Testimonial -->
    <?php
    $testimonials = get_option('testimonial', []);
    $responsive = [
        0 => [
            'items' => 1
        ],
        768 => [
            'items' => 2
        ],
        992 => [
            'items' => 2
        ],
        1200 => [
            'items' => 3
        ],
    ];

    $testimonial_bgr = get_option('testimonial_background', '#dd556a');
    ?>
    @if(count($testimonials))
        <div class="section section-background pt-5 pb-5 mt-4" style="background-color: {{$testimonial_bgr}};">
            <div class="container">
                <h2 class="h3 mt-0 c-white">{{__('Say about Us')}}</h2>
                <p class="c-white">{{__('Browse beautiful places to stay with all the comforts of home, plus more')}}</p>
                <div class="hh-testimonials">
                    <div class="hh-carousel carousel-padding nav-style2"
                         data-responsive="{{ base64_encode(json_encode($responsive)) }}" data-margin="30" data-loop="0">
                        <div class="owl-carousel">
                            @foreach($testimonials as $testimonial)
                                <div class="item">
                                    <div class="testimonial-item">
                                        <div class="testimonial-inner">
                                            <div class="author-avatar">
                                                <img
                                                    src="{{ get_attachment_url($testimonial['author_avatar'], [80, 80]) }}"
                                                    alt="{{get_translate( $testimonial['author_name']) }}"
                                                    class="img-fluid">
                                                <i class="mdi mdi-format-quote-open hh-icon"></i>
                                            </div>
                                            <div class="author-rate">
                                                @include('frontend.components.star', ['rate' => (int) $testimonial['author_rate']])
                                            </div>
                                            <div class="author-comment">
                                                {{ get_translate($testimonial['author_comment']) }}
                                            </div>
                                            <h2 class="author-name">
                                                {{ get_translate($testimonial['author_name']) }}
                                            </h2>
                                            @if($testimonial['date'])
                                                <div
                                                    class="author-date">{{sprintf(__('on %s'), date(hh_date_format(), strtotime($testimonial['date'])))}}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="owl-nav">
                            <a href="javascript:void(0)"
                               class="prev"><i class="ti-angle-left"></i></a>
                            <a href="javascript:void(0)"
                               class="next"><i class="ti-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endif
<!-- List of Blog -->
    <div class="container">
        <?php
        $list_services = \App\Controllers\PostController::get_inst()->listOfPosts([
            'number' => 2
        ]);
        $responsive = [
            0 => [
                'items' => 1
            ]
        ];
        ?>
        @if(count($list_services['results']))
            <h2 class="h3 mt-4 mb-3">{{__('The latest from Blog')}}</h2>
            <div class="hh-list-of-blog">
                <div class="row">
                    @foreach($list_services['results'] as $item)
                        <div class="col-12 col-md-6">
                            <div class="hh-blog-item style-2">
                                <a href="{{ get_the_permalink($item->post_id, $item->post_slug, 'post') }}">
                                    <div class="thumbnail">
                                        <div class="thumbnail-outer">
                                            <div class="thumbnail-inner">
                                                <img src="{{ get_attachment_url($item->thumbnail_id, 'full') }}"
                                                     alt="{{ get_attachment_alt($item->thumbnail_id ) }}"
                                                     class="img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <div class="category">{{__('Action')}}
                                    <div class="date">{{ date(hh_date_format(), $item->created_at) }}</div>
                                </div>
                                <h2 class="title"><a
                                        href="{{ get_the_permalink($item->post_id, $item->post_slug, 'post') }}">{{ get_translate($item->post_title) }}</a>
                                </h2>
                                <div
                                    class="description">{!! balanceTags(short_content(get_translate($item->post_content), 55)) !!}</div>
                                <div class="w-100 mt-2"></div>
                                <div class="d-flex justify-content-between">
                                    <?php
                                    $url = get_the_permalink($item->post_id, $item->post_slug, 'post');
                                    $img = get_attachment_url($item->thumbnail_id);
                                    $desc = get_translate($item->post_title);

                                    $share = [
                                        'facebook' => [
                                            'url' => $url
                                        ],
                                        'twitter' => [
                                            'url' => $url
                                        ],
                                        'pinterest' => [
                                            'url' => $url,
                                            'img' => $img,
                                            'description' => $desc
                                        ]
                                    ];
                                    ?>
                                    @include('frontend.components.share', ['share' => $share])
                                    <a href="{{ get_the_permalink($item->post_id, $item->post_slug, 'post') }}"
                                       class="read-more">{{__('Keep Reading')}} {!! balanceTags(get_icon('002_right_arrow', '#F8546D', '12px', '')) !!}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@include('frontend.components.footer')
