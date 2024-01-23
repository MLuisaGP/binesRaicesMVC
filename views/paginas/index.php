<main class="contenedor seccion"><!--//*iconos sobre nosotros-->
        <h1>Más Sobre Nosotros</h1>
        <?php include 'iconos.php'?>
    </main><!--//?iconos sobre nosotros-->
    <section class="seccion contenedor"><!--//*Propiedades-->
        <h2>Casas y Departamentos en Venta</h2>
       <?php
        include 'listado.php'
       ?>
        <div class="alinear-derecha">  
            <a href="/propiedades" class="boton-verde">Ver Todas</a>
        </div>
    </section><!--//?Propiedades-->
    <section class="imagen-contacto"> <!--//*imagen contacto-->
        <h2>Encuentra la casa de tus sueños</h2>
        <p>Llena el formulario de contacto y un asesor se pondrá en contacto contigo a la brevedad</p>
        <div class="btn-contacto">
            <a href="/contacto" class="boton-amarillo">Contactános</a>
        </div>
    </section><!--//?imagen contacto-->

    <div class="contenedor seccion seccion-inferior">
        <section class="blog"><!--//*blog-->
            <h3>Nuestro Blog</h3>
            <article class="entrada-blog"><!--//*Entada de blog 1-->
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog1.webp" type="image/webp">
                        <source srcset="build/img/blog1.avif" type="image/avif">
                        <img loading="lazy" src="build/img/blog1.jpg" type="image/jpg" alt="Imagen Blog 1">
                    </picture>
                </div>
                <div class="texto-entrada">
                    <a href="/entrada">
                        <h4>Terraza en el techo de tu casa</h4>
                        <p class="informacion-meta">Escrito el: <span>20/10/2023</span> por: <span>Admin</span></p>
                        <p> Consejos para construir una terraza en el techo de tu casa con los mejores materiales y ahorrando dinero</p>
                    </a>
                </div>
            </article><!--//?Entada de blog 1-->

            <article class="entrada-blog"><!--//*Entada de blog 2-->
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog2.webp" type="image/webp">
                        <source srcset="build/img/blog2.avif" type="image/avif">
                        <img loading="lazy" src="build/img/blog2.jpg" type="image/jpg" alt="Imagen Blog 2">
                    </picture>
                </div>
                <div class="texto-entrada">
                    <a href="/entrada">
                        <h4>Guia para la decoración de tu hogar</h4>
                        <p class="informacion-meta">Escrito el: <span>20/10/2023</span> por: <span>Admin</span></p>
                        <p> Maximiz el espacio en tu hogar con esta guía, aprende a combinar mubles y colores para darle vida a tu espacio</p>
                    </a>
                </div>
            </article><!--//?Entada de blog 2-->
        </section><!--//?blog-->

        <section class="testimoniales">
            <h3>Testimoniales</h3>
            <div class="testimonial">
                <blockquote>
                    El personal se comportó de una escelente forma, muy buena atención y la casa que me ofrecieron cumple con todas mis expectivas.
                </blockquote>
                <p>-Juan De la torre</p>
            </div>
        </section>
    </div>