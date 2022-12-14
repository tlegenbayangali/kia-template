<?php
get_header();
get_template_part('template-parts/breadcrumbs');
?>
    <div id="accessories-app">
        <div class="container">
            <div class="row mt-4 mt-xl-0">
                <div class="col-lg-12 d-flex flex-column flex-md-row justify-content-md-between align-items-md-center">
                    <h1>
                        <?php
                        the_archive_title();
                        ?>
                    </h1>
                    <input type="search" v-model="search_query" placeholder="Введите артикул" class="query-input">
                </div>
            </div>
        </div>
        <hr>
        <section class="accessories pb-60" id="accessories">
            <div class="container">
                <div class="row mt-60 grid-30">
                    <div v-if="filteredGoods.length" class="col-12 col-md-6 col-xl-4" v-for="good in filteredGoods" :key="good.id">
                        <div class="d-flex h-100-p w-100-p flex-column justify-content-between model">
                            <div class="accessories-card">
                                <div class="img">
                                    <a :href="'/accessories/' + good.slug">
                                        <img :src="good.thumbnail" :alt="'Аксессуары Kia ' + good.title">
                                    </a>
                                </div>
                                <div class="title mt-20">
                                    <div class="d-flex flex-column">
                                        <a :href="'/accessories/' + good.slug">
                                            <span class="mr-2 fz-15">
                                                {{ good.title }}
                                            </span>
                                        </a>
                                        <p class="c-disabled mt-10">
                                            {{ good.sku }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <span v-else>Аксессуары не найдены...</span>
                </div>
            </div>
        </section>
    </div>
<?php
get_footer();
