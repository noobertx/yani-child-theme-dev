<?php
global $current_user, $yani_local;
$userID = get_current_user_id();
$username               =   get_the_author_meta( 'user_login' , $userID );
$user_title             =   get_the_author_meta( 'yani_author_title' , $userID );
$first_name             =   get_the_author_meta( 'first_name' , $userID );
$last_name              =   get_the_author_meta( 'last_name' , $userID );
$user_email             =   get_the_author_meta( 'user_email' , $userID );
$user_mobile            =   get_the_author_meta( 'yani_author_mobile' , $userID );
$user_whatsapp          =   get_the_author_meta( 'yani_author_whatsapp' , $userID );
$user_phone             =   get_the_author_meta( 'yani_author_phone' , $userID );
$description            =   get_the_author_meta( 'description' , $userID );
$userlangs              =   get_the_author_meta( 'yani_author_language' , $userID );
$user_company           =   get_the_author_meta( 'yani_author_company' , $userID );
$tax_number             =   get_the_author_meta( 'yani_author_tax_no' , $userID );
$fax_number             =   get_the_author_meta( 'yani_author_fax' , $userID );
$user_address           =   get_the_author_meta( 'yani_author_address' , $userID );
$service_areas          =   get_the_author_meta( 'yani_author_service_areas' , $userID );
$specialties            =   get_the_author_meta( 'yani_author_specialties' , $userID );
$license                =   get_the_author_meta( 'yani_author_license' , $userID );
$gdpr_agreement         =   get_the_author_meta( 'gdpr_agreement' , $userID );

if( _yani_user()->role_is("yani_agency") ) {
    $title_position_lable = esc_html__('Agency Name',_yani_theme()->get_text_domain());
    $about_lable = esc_html__( 'About Agency', _yani_theme()->get_text_domain() );
} else {
    $title_position_lable =  esc_html__('Title / Position',_yani_theme()->get_text_domain());
    $about_lable = esc_html__( 'About me', _yani_theme()->get_text_domain() );
}
?>
<h2><?php esc_html_e( 'Information', _yani_theme()->get_text_domain() ); ?></h2>
<div class="dashboard-content-block">
    <div class="row">
        <div class="col-md-3 col-sm-12">
            <?php get_template_part('template-parts/dashboard/profile/photo'); ?>
        </div><!-- col-md-3 col-sm-12 -->

        <div class="col-md-9 col-sm-12">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="username"><?php esc_html_e('Username',_yani_theme()->get_text_domain());?></label>
                        <input disabled type="text" name="username" class="form-control" value="<?php echo esc_attr( $username );?>">
                    </div>
                </div>

                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="useremail"><?php esc_html_e('Email',_yani_theme()->get_text_domain());?></label>
                        <input type="text" name="useremail" class="form-control" value="<?php echo esc_attr( $user_email );?>">
                    </div>
                </div>

                <?php if( !_yani_user()->role_is("yani_agency") ): ?>
                <div class="col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="firstname"><?php esc_html_e('First Name',_yani_theme()->get_text_domain());?></label>
                        <input type="text" name="firstname" class="form-control" value="<?php echo esc_attr( $first_name );?>" placeholder="<?php esc_html_e('Enter your first name',_yani_theme()->get_text_domain());?>">
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="lastname"><?php esc_html_e('Last Name',_yani_theme()->get_text_domain());?></label>
                        <input type="text" name="lastname" class="form-control" value="<?php echo esc_attr( $last_name );?>" placeholder="<?php esc_html_e('Enter your last name',_yani_theme()->get_text_domain());?>">
                    </div>
                </div>
                <?php endif; ?>

                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="display_name"><?php esc_html_e('Select Your Public Name', _yani_theme()->get_text_domain()); ?></label>
                        <select name="display_name" class="selectpicker form-control" id="display_name" data-live-search="false">
                            <?php
                                $public_display = array();
                                $public_display['display_username']  = $current_user->user_login;
                                $public_display['display_nickname']  = $current_user->nickname;
                                
                                if(!empty($current_user->first_name)) {
                                    $public_display['display_firstname'] = $current_user->first_name;
                                }
                                
                                if(!empty($current_user->last_name)) {
                                    $public_display['display_lastname'] = $current_user->last_name;
                                }
                                
                                if(!empty($current_user->first_name) && !empty($current_user->last_name) ) {
                                    $public_display['display_firstlast'] = $current_user->first_name . ' ' . $current_user->last_name;
                                    $public_display['display_lastfirst'] = $current_user->last_name . ' ' . $current_user->first_name;
                                }
                                
                                if(!in_array( $current_user->display_name, $public_display)) {
                                    $public_display = array( 'display_displayname' => $current_user->display_name ) + $public_display;
                                    $public_display = array_map( 'trim', $public_display );
                                    $public_display = array_unique( $public_display );
                                }

                                foreach ($public_display as $id => $item) {
                            ?>
                                <option id="<?php echo esc_attr($id); ?>" value="<?php echo esc_attr($item); ?>"<?php selected( $current_user->display_name, $item ); ?>><?php echo esc_attr($item); ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>

                <?php if(!_yani_user()->role_is("yani_buyer")) { ?>
                <div class="col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="title"><?php echo esc_attr($title_position_lable); ?></label>
                        <input type="text" name="title" value="<?php echo esc_attr( $user_title );?>" class="form-control" placeholder="<?php esc_html_e('Enter your title or position',_yani_theme()->get_text_domain());?>">
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="license"><?php esc_html_e('License',_yani_theme()->get_text_domain());?></label>
                        <input type="text" name="license" value="<?php echo esc_attr( $license );?>" class="form-control" placeholder="<?php esc_html_e('Enter your license',_yani_theme()->get_text_domain());?>">
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="usermobile"><?php esc_html_e('Mobile',_yani_theme()->get_text_domain());?></label>
                        <input type="text" name="usermobile" class="form-control" value="<?php echo esc_attr( $user_mobile );?>" placeholder="<?php esc_html_e('Enter your mobile phone number',_yani_theme()->get_text_domain());?>">
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="whatsapp"><?php esc_html_e('WhatsApp',_yani_theme()->get_text_domain());?></label>
                        <input type="text" name="whatsapp" class="form-control" value="<?php echo esc_attr( $user_whatsapp );?>" placeholder="<?php esc_html_e('Enter your whatsapp number with country code',_yani_theme()->get_text_domain());?>">
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="tax_number"><?php esc_html_e('Tax Number',_yani_theme()->get_text_domain());?></label>
                        <input type="text" name="tax_number" value="<?php echo esc_attr( $tax_number );?>" class="form-control" placeholder="<?php esc_html_e('Enter your tax number',_yani_theme()->get_text_domain());?>">
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="userphone"><?php esc_html_e('Phone',_yani_theme()->get_text_domain());?></label>
                        <input type="text" name="userphone" class="form-control" value="<?php echo esc_attr( $user_phone );?>" placeholder="<?php esc_html_e('Enter your phone number',_yani_theme()->get_text_domain());?>">
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="fax_number"><?php esc_html_e('Fax Number',_yani_theme()->get_text_domain());?></label>
                        <input type="text" name="fax_number" class="form-control" value="<?php echo esc_attr( $fax_number );?>" placeholder="<?php esc_html_e('Enter your fax number',_yani_theme()->get_text_domain());?>">
                    </div>
                </div>
                
                <div class="col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="userlangs"><?php esc_html_e('Language',_yani_theme()->get_text_domain());?></label>
                        <input type="text" name="userlangs" placeholder="<?php echo esc_html__('English, Spanish, French', _yani_theme()->get_text_domain()); ?>" class="form-control" value="<?php echo esc_attr( $userlangs );?>">
                    </div>
                </div>

                <?php if( !_yani_user()->role_is("yani_agency") ): ?>
                <div class="col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="user_company"><?php esc_html_e('Company Name',_yani_theme()->get_text_domain());?></label>
                        <input type="text" name="user_company" placeholder="<?php esc_html_e('Enter your company name',_yani_theme()->get_text_domain());?>" class="form-control" value="<?php echo esc_attr( $user_company );?>">
                    </div>
                </div>
                <?php endif; ?>

                <div class="col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="about"><?php esc_html_e( 'Address', _yani_theme()->get_text_domain() ); ?></label>
                        <input type="text" name="user_address" class="form-control" value="<?php echo esc_attr( $user_address );?>" placeholder="<?php esc_html_e('Enter your address',_yani_theme()->get_text_domain());?>">
                    </div>
                </div>

                <div class="col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="service_areas"><?php esc_html_e( 'Service Areas', _yani_theme()->get_text_domain() ); ?></label>
                        <input type="text" name="service_areas" class="form-control" value="<?php echo esc_attr( $service_areas );?>" placeholder="<?php esc_html_e('Enter your service areas',_yani_theme()->get_text_domain());?>">
                    </div>
                </div>

                <div class="col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="specialties"><?php esc_html_e( 'Specialties', _yani_theme()->get_text_domain() ); ?></label>
                        <input type="text" name="specialties" class="form-control" value="<?php echo esc_attr( $specialties );?>" placeholder="<?php esc_html_e('Enter your specialties',_yani_theme()->get_text_domain());?>">
                    </div>
                </div>

                <?php } ?>
                <div class="col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="about"><?php echo esc_attr($about_lable); ?></label>
                        <?php
                        $editor_id = 'about';
                        $settings = array(
                            'media_buttons' => false,
                            'textarea_rows' => 6,
                        );
                        if ( !empty($description) ) {
                            wp_editor($description, $editor_id, $settings);
                        } else {
                            wp_editor('', $editor_id, $settings);
                        }
                        ?>
                    </div>
                </div>
            </div><!-- row -->
            <button class="yani_update_profile btn btn-success">
                <?php get_template_part('template-parts/loader'); ?>
                <?php esc_html_e('Update Profile', _yani_theme()->get_text_domain()); ?>
            </button><br/>
            <div class="notify"></div>
        </div><!-- col-md-9 col-sm-12 -->
    </div><!-- row -->
</div><!-- dashboard-content-block -->