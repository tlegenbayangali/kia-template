<?php
get_header();
get_template_part('template-parts/breadcrumbs');
$data = json_decode(file_get_contents("https://kia-bridge.dlcd.kz/api/cars/models"));
echo '<pre>';
print_r($data);
echo '</pre>';
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
        <section class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <div class="counter">
                            {{ filteredGoods.length }}
                            <span v-if="filteredGoods.length == 1">аксессуар</span>
                            <span v-else-if="filteredGoods.length > 1 && filteredGoods.length < 5">аксессуара</span>
                            <span v-else>аксессуаров</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="view-selector">
                            <ul class="d-flex justify-content-end">
                                <li class="list mr-10" :class="{ active: view_mode == 'list' }" @click="changeViewMode('list')">
                                    <svg data-button-layout-accessories="table" width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0 0h4v4H0zM6 0h14v4H6zM0 8h4v4H0zM6 8h14v4H6zM0 16h4v4H0zM6 16h14v4H6z"></path>
                                    </svg>
                                </li>
                                <li class="grid" :class="{ active: view_mode == 'grid' }" @click="changeViewMode('grid')">
                                    <svg data-button-layout-accessories="grid" width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0 0h9v9H0zM11 0h9v9h-9zM0 11h9v9H0zM11 11h9v9h-9z"></path>
                                    </svg>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="accessories pb-60" id="accessories">
            <div class="container">
                <div class="row mt-60 grid-30">
                    <div v-if="filteredGoods.length" class="col-12" :class="{'col-md-6 col-xl-4': view_mode === 'grid', 'accessories-card-wrapper': view_mode === 'list'}" v-for="good in filteredGoods" :key="good.id">
                        <div class="d-flex h-100-p w-100-p flex-column justify-content-between model">
                            <a :href="'/accessories/' + good.slug" class="accessories-card" :class="{'accessories-card-list-mode': view_mode === 'list'}">
                                <div class="img">
                                    <img :src="good.thumbnail" :alt="'Аксессуары Kia ' + good.title">
                                </div>
                                <div class="title mt-20">
                                    <div class="d-flex flex-column">
                                        <span class="mr-2 fz-15">
                                            {{ good.title }}
                                        </span>
                                        <p class="c-disabled mt-10">
                                            {{ good.sku }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <span v-else>Аксессуары не найдены...</span>
                </div>
            </div>
        </section>
    </div>
<?php
get_footer();
