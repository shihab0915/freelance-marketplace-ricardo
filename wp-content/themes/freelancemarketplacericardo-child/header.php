<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage FreelanceEngine
 * @since FreelanceEngine 1.0
 */
global $current_user;
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<?php global $user_ID; ?>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1 ,user-scalable=no">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php ae_favicon(); ?>
	<?php
	wp_head();
	if ( function_exists( 'et_render_less_style' ) ) {
		//et_render_less_style();
	}

	?>
</head>

<body <?php body_class(); ?>>
<!-- <div class="fre-wrapper"> -->
<header class="fre-header-wrapper">
    <div class="fre-header-wrap" id="main_header">
        <div class="container">
            <div class="fre-site-logo">
                <a href="<?php echo home_url(); ?>">
					<?php fre_logo( 'site_logo' ) ?>
                </a>
                <div class="fre-hamburger">
					<?php if ( is_user_logged_in() ) { ?>
                        <a class="fre-notification notification-tablet" href="">
                            <i class="fa fa-bell-o" aria-hidden="true"></i>
							<?php
							if ( function_exists( 'fre_user_have_notify' ) ) {
								$notify_number = fre_user_have_notify();
								if ( $notify_number ) {
									echo '<span class="dot-noti"></span>';
								}
							}
							?>
                        </a>
					<?php } ?>
                    <span class="hamburger-menu">
                            <div class="hamburger hamburger--elastic" tabindex="0" aria-label="Menu" role="button"
                                 aria-controls="navigation">
                                <div class="hamburger-box">
                                    <div class="hamburger-inner"></div>
                                </div>
                            </div>
                        </span>
                </div>
            </div>

			<?php if ( is_user_logged_in() ) { ?>
                <div class="fre-account-tablet">
                    <div class="fre-account-info">
						<?php echo get_avatar( $user_ID ); ?>
                        <span><?php echo $current_user->display_name; ?></span>
                    </div>
                </div>
			<?php } ?>
            <div class="fre-search-wrap">
				<?php
				global $wp;
				$active_profile = '';
				$active_project = '';
				$action_link    = '';
				$input_hint     = '';
				$current_url    = home_url( add_query_arg( array(), $wp->request ) );
				$current_url    = $current_url . '/';

				if ( is_user_logged_in() ) {
					$user_data = get_userdata( $current_user->ID );
					$user_role = implode( ', ', $user_data->roles );
					if ( $user_role == 'freelancer' ) {
						$active_project = 'active';
						$action_link    = get_post_type_archive_link( PROJECT );
						$input_hint     = __( 'Find Projects', ET_DOMAIN );
					} else if ( $user_role == 'employer' ) {
						$active_profile = 'active';
						$action_link    = get_post_type_archive_link( PROFILE );
						$input_hint     = __( 'Find Freelancers', ET_DOMAIN );
					} else {
						$active_profile = 'active';
						$action_link    = get_post_type_archive_link( PROFILE );
						$input_hint     = __( 'Find Freelancers', ET_DOMAIN );
					}
				} else {
					$active_profile = 'active';
					$action_link    = get_post_type_archive_link( PROFILE );
					$input_hint     = __( 'Find Freelancers', ET_DOMAIN );
				}

				if ( $current_url == get_post_type_archive_link( PROJECT ) ) {
					$active_project = 'active';
					$active_profile = '';
					$action_link    = get_post_type_archive_link( PROJECT );
					$input_hint     = __( 'Find Projects', ET_DOMAIN );
				} else if ( $current_url == get_post_type_archive_link( PROFILE ) ) {
					$active_profile = 'active';
					$active_project = '';
					$action_link    = get_post_type_archive_link( PROFILE );
					$input_hint     = __( 'Find Freelancers', ET_DOMAIN );
				}
				?>

                <form class="fre-form-search" action="<?php echo $action_link; ?>" method="post">
                    <div class="fre-search dropdown">
                            <span class="fre-search-dropdown-btn dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-search" aria-hidden="true"></i>
                                <i class="fa fa-caret-down" aria-hidden="true"></i>
                            </span>
                        <input class="fre-search-field" name="keyword"
                               value="<?php echo isset( $_POST['keyword'] ) ? $_POST['keyword'] : "" ?>" type="text"
                               placeholder="<?php echo $input_hint; ?>">
                        <ul class="dropdown-menu fre-search-dropdown">
                            <li><a class="<?php echo $active_profile; ?>" data-type="profile"
                                   data-action="<?php echo get_post_type_archive_link( PROFILE ); ?>"><?php _e( 'Find Freelancers', ET_DOMAIN ); ?></a>
                            </li>
                            <li><a class="<?php echo $active_project; ?>" data-type="project"
                                   data-action="<?php echo get_post_type_archive_link( PROJECT ); ?>"><?php _e( 'Find Projects', ET_DOMAIN ); ?></a>
                            </li>
                        </ul>
                    </div>
                </form>
            </div>

			<?php if ( is_user_logged_in() ) { ?>
                <div class="fre-account-info-tablet">
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo et_get_page_link( "profile" ) ?>"><?php _e( 'MY PROFILE', ET_DOMAIN ); ?></a>
                        </li>
						<?php do_action( 'fre_header_before_notify' ); ?>
                        <li><a href="<?php echo wp_logout_url(); ?>"><?php _e( 'LOGOUT', ET_DOMAIN ); ?></a></li>
                    </ul>
                </div>
			<?php } ?>
            <div class="fre-menu-top">
                <ul class="fre-menu-main">
                    <!-- Menu freelancer -->

                    <!-- Main Menu -->
					<?php if ( has_nav_menu( 'et_header_standard' ) ) { ?>
                        <li class="fre-menu-page dropdown">
                            <a><?php _e( 'Projects', ET_DOMAIN ); ?><i class="fa fa-caret-down" aria-hidden="true"></i></a>
							<?php
							$args = array(
								'theme_location'  => 'et_header_standard',
								'menu'            => '',
								'container'       => '',
								'container_class' => '',
								'container_id'    => '',
								'menu_class'      => 'dropdown-menu',
								'menu_id'         => '',
								'echo'            => true,
								'before'          => '',
								'after'           => '',
								'link_before'     => '',
								'link_after'      => ''
							);
							wp_nav_menu( $args );
							?>
                        </li>
					<?php } ?>

<!-- Employer menu start-->
 <?php
 $user = wp_get_current_user();
 if( in_array( 'employer', (array) $user->roles ) ){ ?>
     <li><a href="<?php echo site_url('/my-project'); ?>">My Projects</a></li>
     <li><a href="<?php echo site_url('/profiles'); ?>">Freelancers</a></li>
 <?php }
 ?>
<!--Employer menu end-->

<!--Freelancer menu start -->
<?php
$user = wp_get_current_user();
if( in_array( 'freelancer', (array) $user->roles ) ){ ?>
    <li><a href="<?php echo site_url('/my-project'); ?>">My Projects</a></li>
    <li><a href="<?php echo site_url('/projects'); ?>">Find Jobs</a></li>
<?php }
?>
<!--Freelancer menu end -->

                    <!-- Main Menu -->
                </ul>
            </div>

			<?php if ( ! is_user_logged_in() ) { ?>
                <div class="fre-account-wrap">
                    <div class="fre-login-wrap">
                        <ul class="fre-login">
                            <li>
                                <a href="#" data-toggle="modal" data-target="#howitworks">HOW IT WORKS</a>
                            </li>
                            <li>
                                <a href="<?php echo et_get_page_link( "login" ) ?>"><?php _e( 'LOGIN', ET_DOMAIN ); ?></a>
                            </li>
							<?php if ( fre_check_register() ) { ?>
                                <li>
                                    <a href="<?php echo et_get_page_link( "register" ) ?>"><?php _e( 'SIGN UP', ET_DOMAIN ); ?></a>
                                </li>
                                <a id="postajob" href="<?php echo site_url('/submit-project'); ?>">POST A JOB</a>
							<?php } ?>
                        </ul>

                </div>
			<?php } else { ?>
                <div class="fre-account-wrap dropdown">
                    <a class="fre-notification dropdown-toggle" data-toggle="dropdown" href="">
                        <i class="fa fa-bell-o" aria-hidden="true"></i>
						<?php
						if ( function_exists( 'fre_user_have_notify' ) ) {
							$notify_number = fre_user_have_notify();
							if ( $notify_number ) {
								echo '<span class="dot-noti"></span>';
							}
						}
						?>
                    </a>
					<?php fre_user_notification( $user_ID, 1, 5 ); ?>
                    <div class="fre-account dropdown">
                        <div class="fre-account-info dropdown-toggle" data-toggle="dropdown">
							<?php echo get_avatar( $user_ID ); ?>
                            <span><?php echo $current_user->display_name; ?></span>
                            <i class="fa fa-caret-down" aria-hidden="true"></i>
                        </div>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="<?php echo et_get_page_link( "profile" ) ?>"><?php _e( 'MY PROFILE', ET_DOMAIN ); ?></a>
                            </li>
							<?php do_action( 'fre_header_before_notify' ); ?>
                            <li><a href="<?php echo wp_logout_url(); ?>"><?php _e( 'LOGOUT', ET_DOMAIN ); ?></a></li>
                        </ul>
                    </div>
                </div>
			<?php } ?>
        </div>
    </div>
</header>

<!--Modal How it works-->
<div class="modal fade" id="howitworks">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="h5 modal-title">How it works</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span><i class="fas fa-window-close"></i></span>
                </button>
            </div>

            <div class="modal-body">
                <h4 class="text-center"><i class="fas fa-user-tie"></i> <i>If you are an Employer</i></h4>
                <p>
                    First register as an Employer. Post a Job and our freelancers will
                    bid on your project. You can hire any one of them. If you think that
                    none of the freelancers are perfect for your project then you can
                    search for other freelancers and invite them to apply on your project.
                </p>

                <div class="modal-body">
                    <h4 class="text-center"><i class="fas fa-user-clock"></i> <i>If you are a Freelancer</i></h4>
                    <p>
                        Register as a Freelancer and you will find many job posts. Submit
                        proposals on those projects which you can perform well.
                    </p>
                </div>

                <div class="modal-body">
                    <h4 class="text-center"><i class="fas fa-donate"></i> <i><b>Payment</b></i></h4>
                    <p>
                        Every payment made via our platform. It's strictly prohibited
                        transact directly between Employer and Freelancer. We will not
                        take any responsibility for this type of issue. Pay and get paid
                        via our platform and stay safe.
                    </p>
                </div>

            </div>
        </div>
    </div>
</div>
<!--Modal How it works end-->
<!-- MENU DOOR / END -->

<?php
global $user_ID;
if ( $user_ID ) {
	echo '<script type="data/json"  id="user_id">' . json_encode( array(
			'id' => $user_ID,
			'ID' => $user_ID
		) ) . '</script>';
}