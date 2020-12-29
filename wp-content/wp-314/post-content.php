                        <div class="grid__item main__post">
                            <div class="thumb">
                                <?php if($thumb_id): if($thumb_id == 187): echo '<div class="bg logo"></div>'; else: the_post_thumbnail('thumbNews'); echo '<div class="bg" style="background-image: url('.$thumb[0].')"></div>'; endif; else: echo '<div class="bg logo"></div>'; endif; ?>                    
                            </div>

                            <article class="main__post__content content">
                                <div class="meta"><?php echo get_the_date('d.m.Y'); ?></div>
                                <a href="<?php the_permalink(); ?>" class="main__post__title"><h5 ><?php the_title(); ?></h5></a> 
                                <article>
                                    <?php the_excerpt();//the_content(); ?>
                                </article>
                                <a href="<?php the_permalink(); ?>" class="more">></a>
                            </article>
                        </div>