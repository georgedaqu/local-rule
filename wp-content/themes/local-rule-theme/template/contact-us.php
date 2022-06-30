<?php
/* Template Name: Contact Us */

get_header();

$instagram = get_field('field_62ac908ff306d', 'options');
$facebook = get_field('field_62ac90a7f306e', 'options');
$office_address = get_field('field_62ac8d59985e4');
$phone = get_field('field_62ac8db3985e5');
$email_for_business_inquiries = get_field('field_62ac8dc3985e6');
$email_for_local_rule_shop_inquiries = get_field('field_62ac8de8985e7');
?>

<main>
    <div class="contact_wrapper">
        <div class="contact_info">
            <h1>Contact us</h1>
            <ul class="contact_details">
                <li>
                    <em class="fa-solid fa-location-dot"></em>
                    <div class="details">
                        <h3>Office:</h3>
                        <address><?php echo $office_address; ?></address>
                    </div>
                </li>
                <li>
                    <em class="fa-solid fa-phone"></em>
                    <div class="details">
                        <h3>Phone:</h3>
                        <a href="tel:+<?php echo $phone; ?>">+<?php echo $phone; ?></a>
                    </div>
                </li>
                <li>
                    <em class="fa-solid fa-envelope"></em>
                    <div class="details">
                        <h3>For business inquiries:</h3>
                        <a href="mailto:<?php echo $email_for_business_inquiries; ?>"><?php echo $email_for_business_inquiries; ?></a>
                    </div>
                </li>
                <li>
                    <em class="fa-solid fa-envelope"></em>
                    <div class="details">
                        <h3>For Local Rule shop inquiries:</h3>
                        <a href="mailto:<?php echo $email_for_local_rule_shop_inquiries; ?>"><?php echo $email_for_local_rule_shop_inquiries; ?></a>
                    </div>
                </li>
            </ul>
            <h2>Follow us</h2>
            <ul class="social_links">
                <li>
                    <a href="<?php echo $instagram; ?>" target="_blank" class="insta_link">
                        <em class="fa-brands fa-instagram"></em>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $facebook; ?>" target="_blank" class="fb_link">
                        <em class="fa-brands fa-facebook-f"></em>
                    </a>
                </li>
            </ul>
        </div>
        <div class="contact_image">
            <figure>
                <img src="<?php echo get_the_post_thumbnail_url($post, 'about-us-text-image'); ?>" alt="">
            </figure>
        </div>
    </div>
</main>

<?php get_footer(); ?>
