<?php
/*
Template Name: Страница контакты
Template Post Type: page
*/

get_header( );?>
<section class="section-dark">
    <div class="container">
        <?php the_title('<h1 class="page-title">', '</h1>', true);?>
        <div class="contacts-wrapper">
            <div class="left">
                <h2 class="contacts-title">Через форму обратной связи</h2>
                <!-- <form action="form.php" class="contacts-form" method="POST">
                    <input name="contact_name" type="text" class="input contacts-input" placeholder="Ваше имя">
                    <input name="contact_email" type="text" class="input contacts-input" placeholder="Ваш email">
                    <textarea name="contact_comment" id="" class="textarea contacts-textarea" placeholder="Ваш вопрос">

                    </textarea>
                    <button type="submit" class="button more">
                        Отправить
                    </button>

                </form> -->
                <?php echo do_shortcode( '[contact-form-7 id="128" title="Контактная форма"]' ); ?>
            </div>
            <!-- left -->
            <div class="right">
                <h2 class="contacts-title">Или по этим контактам</h2>
                            <?php 
                            //делаем проверку есть ли доп поле емаил и адрес
                                $email = get_post_meta( get_the_ID(), 'email', true);
                                if ($email){
                                    echo '<a href="mailto:' . $email . '">' . $email . '</a>';
                                }
                            
                                $address = get_post_meta( get_the_ID(), 'adress', true);
                                if ($address){
                                    echo '<address>' . $address . '</address>';
                                }

                                $phone = get_post_meta( get_the_ID(), 'phone', true);
                                if ($phone){
                                    echo '<a href="tel:' . $phone . '">' . $phone . '</a>';
                                }
                            
                             echo the_field('date');
                            ?>
            </div>
            <!-- right -->
        </div>
        <!-- contacts wrapper -->
    </div>
    <!-- container -->
</section>
<!-- section dark -->
<?php get_footer();?>