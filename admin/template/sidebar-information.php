<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

$plugin_dir = plugins_url('block-icons-google/');

$image_url = $plugin_dir;
?>
<div class="container-sidebar">
    <div class="boxes">
        <h3><?php esc_html_e('About Developer', 'block-icons-google'); ?></h3>
        <img class="developer" src="<?php echo esc_url($image_url . 'assets/images/yukyhendiawan.jpg'); ?>" alt="about developer">
        <p class="desc"><?php esc_html_e("Hello, I'm Yuky Hendiawan, an experienced WordPress developer with over 5 years of expertise.", 'block-icons-google'); ?></p>
        <p class="desc"><?php esc_html_e("As a Freelancer, I am actively engaged in a variety of WordPress development projects.", 'block-icons-google'); ?></p>
        <p class="desc"><?php esc_html_e("My expertise includes creating plugins, designing custom themes, tailoring both plugins and themes to meet specific requirements.", 'block-icons-google'); ?></p>
        <p class="desc"><?php esc_html_e("If you need a WordPress developer, feel free to contact me.", 'block-icons-google'); ?></p>
        <p class="desc"><?php esc_html_e("Contact:", 'block-icons-google'); ?></p>
        <div class="boxes-sosmed">
            <ul>
                <li>
                    <a rel="nofollow noreferrer noopener" href="https://www.upwork.com/freelancers/~01559dc6ef8a329c82" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512">
                            <path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zM270.8 274.3c5.2 8.4 23.6 29.9 51.5 29.9v0c25.2 0 44.9-20.2 44.9-49.7s-19.4-49.7-44.9-49.7s-44.9 16.7-51.5 69.5zm-26.7-41.8c7.3-30.5 32.7-60.1 78.2-60.1l0 0c45.1 0 80.9 35.2 80.9 82.2s-35.9 81.9-80.9 81.9c-.6 0-1.1 0-1.7 0c-.5 0-1.1 0-1.6 0h-.1c-14.5-.5-28.7-4.8-40.9-12.6c-4.7-2.8-9.1-6-13.4-9.5l-12.8 78.4H214.9l19.4-110.6c-20.8-29.1-31.6-62.4-36.2-79.7V255c0 48-30.5 81.5-74.2 81.5c-22 0-41-8-54.8-23.3c-13.4-14.8-20.8-35.5-20.8-58.3V176.8H84.5l-.3 78.2c0 28.4 14.5 49.3 39.8 49.3s38.2-20.9 38.2-49.3V176.8h62.8c4.8 19.3 10.9 40.1 19.2 55.6z" />
                        </svg>
                        <span><?php esc_html_e("Upwork", "block-icons-google"); ?></span>
                    </a>
                </li>
                <li>
                    <a rel="nofollow noreferrer noopener" href="mailto:yukyhendiawan1998@gmail.com">
                        <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512">
                            <path d="M64 112c-8.8 0-16 7.2-16 16v22.1L220.5 291.7c20.7 17 50.4 17 71.1 0L464 150.1V128c0-8.8-7.2-16-16-16H64zM48 212.2V384c0 8.8 7.2 16 16 16H448c8.8 0 16-7.2 16-16V212.2L322 328.8c-38.4 31.5-93.7 31.5-132 0L48 212.2zM0 128C0 92.7 28.7 64 64 64H448c35.3 0 64 28.7 64 64V384c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V128z" />
                        </svg>
                        <span><?php esc_html_e("yukyhendiawan1998@gmail.com", "block-icons-google"); ?></span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>