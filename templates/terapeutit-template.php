<?php 
get_header();
get_body_class();?>

<div class="terapeutit-template-main-wrapper">
    <div class="terapeutit-content-wrapper">
    <div class="terapeutit-template-page-wrapper">
        <?php   
        
        
        if(have_posts()){
            while(have_posts(  )){
                the_post();
                the_content( );
            }
        }
        
        
        
        ?>
    </div>
    <?php   

    $query = new WP_Query( array( 'post_type' => 'yhteystieto', 'orderby' => array('menu_order', 'ID'), 'order' => 'ASC', 'posts_per_page'=>-1 ) );
    $counter = 1;
    ?>

        <?php if($query->have_posts()){ ?>
        <div class="contact-card-container">
            <div class="contact-card-title-wrapper"><h3>Terapeuttien yhteystiedot:</h3></div>
        <?php   while($query->have_posts()){ 
            if($counter % 2 !== 0){?>
                <div class="contact-card-row">  
        <?php }           $query->the_post();
                    //Haetaan postityypin omat lomakekentät metaboxista
                    $custom = get_post_custom();
                        ?>
                
                    <div class="contact-card-wrapper">
                        <div class="contactcard-outer">
                        <div class="stone-vapaita-aikoja">
                                    
                                    <?php if($custom['vapaita-aikoja'][0] == 'True') {?>
                                        <span class="stone-vapaita-aikoja-teksti">        
                                        Vapaita Aikoja!
                                        </span>
                                        <?php  } ?>
                                </div>
                            <div class="contactcard-inner-left">
                                <div class="contactcard-contact-name">
                                    <span class="stone-contact-name">
                                    <?php  the_title(); ?> 
                                    </span>
                                    <br>
                                    <span class="stone-contact-ref">
                                        <?php if(isset($custom['osaaminen'])) {
                                                echo $custom['osaaminen'][0];
                                            }  ?>
                                    </span>
                                    
                                    <div class="contact-region">
                                    <span class="iconify" data-icon="mdi:map-marker-radius-outline" style="color: #88b54a;" data-width="30" data-height="30"></span>
                                        <span class="stone-contact-region">
                                        <?php if(isset($custom['paikkakunnat'])) {
                                                echo $custom['paikkakunnat'][0];
                                            }  ?>
                                        </span>
                                    
                                    </div>
                                    <div class="stone-contact-services-list">
                                        <ul class="stone-services-list">
                                        <?php if(isset($custom['palvelut'])) {
                                                $palvelut = explode(',', $custom['palvelut'][0]);
                                                foreach($palvelut as $key=>$val){ ?>
                                                <li><?php echo "<span> " . trim($val) . "</span>"; ?></li>

                                            <?php    }
                                            }  ?>
                                        </ul>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="contactcard-inner-right">

                            <?php if($custom['etavastaanotto'][0] == 'True') { ?>
                                        <div class="icon-wrapper" id="contact-card-computer-icon"  >
                                            <div class="arrow-down" id="arrow-pnro" >
                                                <div class="contact-infobox">
                                                    <span>Kysy myös etävastaanottoa</span>
                                                </div>
                                            </div>
                                            <span class="iconify" data-icon="icon-park-outline:laptop-computer" style="color: #88b54a;" data-width="25" data-height="25"></span>
                                        </div>
                                        <?php    } ?>
                            <?php if(isset($custom['_thumbnail_id'])) { ?>
                                <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(  ), 'full'); ?>" alt="" class="stone-contact-card-img" id="omakuva">
                            <?php }?>
                                <div class="stone-contact-info">
                                <?php if(!empty($custom['pnro'][0]) ) {?>
                                    <div class="icon-wrapper" id="icon-wrapper-pnro"  >
                                        <div class="arrow-down" id="arrow-pnro" >
                                            <div class="contact-infobox">
                                                <span>Ajanvaraukset:  <?php if(!empty($custom['aika'][0])) {
                                                echo '<br> klo '. $custom['aika'][0];
                                            ?><?php if(!empty($custom['loppuaika'][0])) {
                                                echo ' - '.$custom['loppuaika'][0].' välillä';
                                            } else { echo ' jälkeen'; } }?>  <br> <?php if(isset($custom['pnro'])) {
                                                echo '<a href="tel:' . trim($custom['pnro'][0]) .'">'. $custom['pnro'][0] . '</a>';
                                            }   ?> </span>
                                            </div>
                                        </div> 
                                        <span class="iconify" data-icon="eva:phone-outline" style="color: #88b54a;"></span>
                                    </div>
                                    <?php }  ?>
                                    <?php if(!empty($custom['email'][0]) ) {?>
                                    <div class="icon-wrapper" id="icon-wrapper-email" >
                                        <div class="arrow-down" id="arrow-email" >
                                            <div class="contact-infobox">
                                                <span><a href="mailto:<?php echo $custom['email'][0]; ?>"> <?php echo $custom['email'][0]; ?></a>
                                            </span>
                                            </div>
                                        </div>
                                        <span class="iconify" data-icon="entypo:email" style="color: #88b54a;"></span>
                                    </div>
                                    <?php }  ?>
                                    <?php if(!empty($custom['www'][0]) ) {?>
                                        <div class="icon-wrapper" id="icon-wrapper-www"  >
                                            <div class="arrow-down" id="arrow-www" >
                                                <div class="contact-infobox">
                                                    <span>Klikkaa terapeutin omille <a href="<?php echo $custom['www'][0]; ?>">kotisivuille </a> </span>
                                                </div>
                                            </div>
                                            
                                            <span class="iconify" data-icon="ci:home-alt-outline" style="color: #88b54a;"></span>
                                        </div>
                                    <?php  } ?>
                                </div>
                            </div>
                            <?php if(!empty($custom['lisatietoja'][0]) ) {?>
                            <div class="icon-down-arrow-wrapper">
                                <span class="iconify" data-icon="ep:arrow-down"></span>
                            </div><!-- icon-down-arrow-wrapper -->
                            <div class="contactcard-inner-more-information">
                                <h5><strong>Lisätietoja</strong></h5>
                                <span class="lisatiedot">
                                    <?php echo $custom['lisatietoja'][0]  ?>
                                </span>

                            </div><!-- contactcard-inner-more-information -->
                            <?php  } ?>
                        </div><!-- Contact Card Outer -->
                    </div><!-- Contact Card Wrapper -->
                    <?php 
                    $postCount = wp_count_posts( 'yhteystieto' );
                    if($counter % 2 == 0 || $counter == $postCount->publish){ ?>
                </div> <!-- Row --> 
                    <?php  } $counter++;}; ?>
            </div> <!-- Container -->

            <?php       }; wp_reset_postdata();   ?>  
    <!-- </div> terapeutit template main -->
    <!-- </div>   terapeutit template body -->
    </div>
    <div class="terapeutit-template-sidebar"> <?php get_sidebar();   ?></div>
</div>
<?php 

get_footer();
/* paikkakunnat: Array
osaaminen: Array
palvelut: Array
aika: Array
loppuaika: Array
pnro: Array
email: Array
vapaita-aikoja: Array
www: Array
lisatietoja: Array
_edit_last: Array
_edit_lock: Array
_thumbnail_id: Array */