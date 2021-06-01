<template>
    <transition
        enter-active-class="animate__animated animate__fadeIn"
        leave-active-class="animate__animated animate__fadeOut">
        <div class="container">
            <div class="card-tools" wfd-id="32">
                <div class="input-group input-group-md" style="width: 150px;" wfd-id="33">
                    <router-link class="btn btn-md btn-outline-info mt-3 mb-3" to="/cars">
                        <i class="fas fa-angle-double-left"></i> Retour
                    </router-link>
                </div>
            </div>
            <div class="row justify-content-center mb-5">
                <div class="col-md-9">
                    <div class="card mt-4">
                        <!-- images -->
                        <div>
                            <b-carousel
                            id="carousel-1"
                            v-model="slide"
                            :interval="4000"
                            controls
                            indicators
                            background="#ababab"
                            img-width="1024"
                            img-height="480"
                            style="text-shadow: 1px 1px 2px #333;"
                            @sliding-start="onSlideStart"
                            @sliding-end="onSlideEnd"
                            >
                            <!-- Text slides with image -->
                            <b-carousel-slide
                                v-for="photo in photos" :key="photo.id"
                                :img-src="'http://127.0.0.1:8000/img/cars/' + car.id + '/' + photo.photo"
                            ></b-carousel-slide>

                            </b-carousel>
                        </div>
                        <!-- image-->
                        <!-- <img src="" class="card-img-top" alt=""> -->
                        <div class="card-body">
                            <h5 class="card-title"><b>{{car.type | uper}} {{car.marque | uper}} {{car.annee}}</b></h5>
                            <p class="card-text">{{car.ht | Currency}} MRU</p>
                            <p class="card-text">
                                <small class="text-muted">Ajouter le, {{car.created_at | myDate}}</small>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <!-- Classic tabs -->
                    <div class="classic-tabs border rounded px-4 pt-1 bg-white">

                        <ul class="nav tabs-primary nav-justified" :id="'advancedTab'+car.id" role="tablist">
                            <li class="nav-item">
                            <a class="nav-link active show" :id="'description-tab'+car.id" data-toggle="tab" :href="'#description'+car.id" role="tab" :aria-controls="'description'+car.id" aria-selected="true">Description</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" :id="'info-tab'+car.id" data-toggle="tab" :href="'#info'+car.id" role="tab" :aria-controls="'info'+car.id" aria-selected="false">Information</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" :id="'reviews-tab'+car.id" data-toggle="tab" :href="'#reviews'+car.id" role="tab" :aria-controls="'reviews'+car.id" aria-selected="false">Opérations ({{operations.length}})</a>
                            </li>
                        </ul>
                        <div class="tab-content" :id="'advancedTabContent'+car.id">
                            <div class="tab-pane fade show active" :id="'description'+car.id" role="tabpanel" :aria-labelledby="'description-tab'+car.id">
                            <h5><b>Car Description</b></h5>
                            <p class="small text-muted text-uppercase mb-2">{{car.marque}}</p>
                            <p><span><strong>{{car.ttc | Currency}} MRU</strong></span></p>
                            <p style="white-space: pre;">{{car.description}}</p>
                            <h5>Statut: 
                                <span v-if="car.statut == 'en stock'" class="badge badge-primary badge-pill badge-news">{{car.statut}}</span>
                                <span v-if="car.statut == 'vendu'" class="badge badge-warning badge-pill badge-news">{{car.statut}}</span>
                            </h5>
                            </div>
                            <div class="tab-pane fade" :id="'info'+car.id" role="tabpanel" :aria-labelledby="'info-tab'+car.id">
                            <h5>Additional Information</h5>
                            <table class="table table-striped table-bordered mt-3">
                                <thead>
                                <tr>
                                    <th scope="row" class="w-150 dark-grey-text h6">Dedouaner</th>
                                    <td><em>{{car.dedouaner ? "Oui" : "Non"}}</em></td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row" class="w-150 dark-grey-text h6">Prix Dedouanement</th>
                                    <td><em>{{car.prixDedouanement | Currency}}</em></td>
                                </tr>
                                </tbody>
                            </table>
                            </div>
                            <div class="tab-pane fade" :id="'reviews'+car.id" role="tabpanel" :aria-labelledby="'reviews-tab'+car.id">
                            <h5><b>Listes des operations:</b></h5>
                            <div class="media mt-3 mb-4" v-for=" operation in operations" :key="operation.id">
                                <img class="d-flex mr-3 z-depth-1" src="http://127.0.0.1:8000/img/service.png" width="62" alt="Generic placeholder image">
                                <div class="media-body">
                                <div class="d-sm-flex justify-content-between">
                                    <p class="mt-1 mb-2">
                                    <strong>{{operation.type}}</strong>
                                    <span>– </span><span>{{operation.created_at | myDate}}</span>
                                    </p>
                                    <div class="rating mb-sm-0">{{operation.montant | Currency}} MRU</div>
                                </div>
                                <p class="mb-0">{{operation.description}}</p>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <!-- Classic tabs -->
                </div>
                <div class="col-md-9"><div class="separator">{{car.id+"-"+car.marque+"-"+car.type | uper}}</div></div>
            </div>
        </div>
    </transition>
</template>

<script>
export default {
    data() {
        return {
            slide: 0,
            sliding: null,
            car:{},
            operations:[],
            photos:[],
            operationForm: new Form({
                car_id: '',
                type: '',
                description: '',
                montant: '',
            }),
        }
    },
    methods: {
        carInfo(id){
            axios.get("http://127.0.0.1:8000/api/getCar/"+id)
            .then(( data ) => {
                this.car = data.data.car
                this.operations = data.data.operations
                this.photos = data.data.photos
            });
        },
        onSlideStart(slide) {
            this.sliding = true
        },
        onSlideEnd(slide) {
            this.sliding = false
        },
    },
    mounted(){
        this.carInfo(this.$route.params.id);
    }
}
</script>