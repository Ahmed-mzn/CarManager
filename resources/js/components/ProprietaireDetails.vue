<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card-tools" wfd-id="32">
                    <div class="input-group input-group-md" style="width: 150px;" wfd-id="33">
                        <router-link class="btn btn-md btn-outline-info mt-3 mb-3" to="/proprietaire">
                            <i class="fas fa-angle-double-left"></i> Retour
                        </router-link>
                    </div>
                </div>
                <div class="card card-widget widget-user" wfd-id="55">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header text-white" style="background: url('/img/user-cover.jpg') center center;" wfd-id="68">
                        <h3 class="widget-user-username text-center">{{proprietaire.name | uperText}}</h3>
                        <h5 class="widget-user-desc text-center">Proprietaire</h5>
                    </div>
                    <div class="widget-user-image" wfd-id="67">
                        <img class="img-circle" :src="getProfilePhoto()" alt="User Avatar">
                    </div>
                    <div class="card-footer" wfd-id="56">
                        <div class="row" wfd-id="57">
                        <div class="col-sm-4 border-right" wfd-id="64">
                            <div class="description-block" wfd-id="65">
                            <h5 class="description-header">3,200</h5>
                            <span class="description-text" wfd-id="66">Capitale</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 border-right" wfd-id="61">
                            <div class="description-block" wfd-id="62">
                            <h5 class="description-header">13,000</h5>
                            <span class="description-text" wfd-id="63">Bonnus</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4" wfd-id="58">
                            <div class="description-block" wfd-id="59">
                            <h5 class="description-header">35</h5>
                            <span class="description-text" wfd-id="60">Voitures</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
            </div>
            <div id="body" class="col-md-11 mb-4">
                <div class="card-block">
                    <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h6>
                    <div class="row">
                        <div class="col-sm-6">
                            <p class="m-b-10 f-w-600"><i class="fas fa-at"></i> Email</p>
                            <h6 class="text-muted f-w-400">{{proprietaire.email}}</h6>
                        </div>
                        <div class="col-sm-6">
                            <p class="m-b-10 f-w-600"><i class="fas fa-phone"></i> Phone</p>
                            <h6 class="text-muted f-w-400">{{proprietaire.contact}}</h6>
                        </div>
                    </div>
                    <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">More</h6>
                    <div class="row">
                        <div class="col-sm-6">
                            <p class="m-b-10 f-w-600"><i class="fas fa-info-circle"></i> Description</p>
                            <h6 class="text-muted f-w-400">{{proprietaire.bio}}</h6>
                        </div>
                        <div class="col-sm-6">
                            <p class="m-b-10 f-w-600"><i class="fas fa-clock"></i> Date d'ajout</p>
                            <h6 class="text-muted f-w-400">{{proprietaire.created_at | myDate}}</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ml-auto mt-3 mb-3">
                <button class="btn btn-md btn-success mr-5" data-toggle="modal" data-target="#exampleModal">
                    <i class="fa fa-car"></i> Add Car
                </button>
            </div>
            <div class="row justify-content-center mb-3" v-for="car in  cars" :key="car.id">
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
                                v-for="photo in car.photos" :key="photo.id"
                                :img-src="'http://127.0.0.1:8000/img/cars/' + car.id + '/' + photo.photo"
                            ></b-carousel-slide>

                            </b-carousel>
                        </div>
                        <!-- image-->
                        <!-- <img src="" class="card-img-top" alt=""> -->
                        <div class="card-body">
                            <h5 class="card-title"><b>{{car.type | uperText}} {{car.marque | uperText}} {{car.annee}}</b></h5>
                            <p class="card-text">{{car.ht | Currency}} MRU</p>
                            <p class="card-text">
                                <small class="text-muted">Ajouter le, {{car.created_at | myDate}}</small>
                                <button v-if="car.statut == 'en stock'" @click="vendre(car.id)" class="btn btn-outline-primary float-right">
                                    <i class="fa fa-shopping-cart"></i> Vendre
                                </button>
                                <button v-if="car.statut == 'vendu'" class="btn btn-outline-secondary float-right" disabled>
                                    <i class="fa fa-shopping-cart"></i> Vendu
                                </button>
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
                            <a class="nav-link" :id="'reviews-tab'+car.id" data-toggle="tab" :href="'#reviews'+car.id" role="tab" :aria-controls="'reviews'+car.id" aria-selected="false">Opérations ({{car.operations.length}})</a>
                            </li>
                        </ul>
                        <div class="tab-content" :id="'advancedTabContent'+car.id">
                            <div class="tab-pane fade show active" :id="'description'+car.id" role="tabpanel" :aria-labelledby="'description-tab'+car.id">
                            <h5><b>Car Description</b></h5>
                            <p class="small text-muted text-uppercase mb-2">{{car.marque}}</p>
                            <p><span><strong>{{car.ttc | Currency}} MRU</strong></span></p>
                            <p class="pt-1">{{car.description}}</p>
                            <h5>Statut: 
                                <span v-if="car.statut == 'en stock'" class="badge badge-primary badge-pill badge-news">{{car.statut}}</span>
                                <span v-if="car.statut == 'vendu'" class="badge badge-warning badge-pill badge-news">{{car.statut}}</span>
                            </h5>
                                <div class="d-flex mb-2">
                                    <div class="mr-auto pt-3"><b>Suppression voiture :</b></div>
                                    <div class="p-2"><button @click="deleteCar(car.id)" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt pr-2"></i> Supprimer</button></div>
                                </div>
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
                            <div class="media mt-3 mb-4" v-for=" operation in car.operations" :key="operation.id">
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
                            <hr>
                            <h5 class="mt-4">Ajouter operation</h5>
                            <p>Ici on ajout les operations et les taritements sur la voitures.</p>
                            <form @submit.prevent="addOperation(car.id)">
                                <div>
                                    <!-- Your review -->
                                    <div class="md-form md-outline">
                                    <label for="form766">Description</label>
                                    <textarea v-model="operationForm.description" nom="description" class="md-textarea form-control pr-6" rows="4" 
                                    :class="{ 'is-invalid': operationForm.errors.has('description') }" id="form766" ></textarea>
                                    <has-error :form="operationForm" field="description"></has-error>
                                    </div>
                                    <!-- Name -->
                                    <div class="md-form md-outline">
                                    <label for="form75">Type</label>
                                    <input v-model="operationForm.type" nom="type" type="text" id="form75"
                                        :class="{ 'is-invalid': operationForm.errors.has('type') }" class="form-control pr-6">
                                        <has-error :form="operationForm" field="type"></has-error>
                                    </div>
                                    <!-- Email -->
                                    <div class="md-form md-outline">
                                    <label for="form77">Montant</label>
                                    <input v-model="operationForm.montant" nom="montant" type="text" id="form77" 
                                        :class="{ 'is-invalid': operationForm.errors.has('montant') }" class="form-control pr-6">
                                        <has-error :form="operationForm" field="montant"></has-error>
                                    </div>
                                    <div class="text-right pb-2">
                                    <button type="submit" class="btn btn-primary mt-2">Ajouter Operation</button>
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                    <!-- Classic tabs -->
                </div>
                <div class="col-md-9"><div class="separator">{{car.id+"-"+car.marque+"-"+car.type | uper}}</div></div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form @submit.prevent="addCar()">
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" v-model="Carform.numserie" name="numserie" placeholder="Numero du Serie" 
                        :class="{ 'is-invalid': Carform.errors.has('numserie') }" class="form-control">
                        <has-error :form="Carform" field="numserie"></has-error>
                </div>
                <div class="form-group">
                    <input type="text" v-model="Carform.marque" name="marque" placeholder="Marque du voiture" 
                        :class="{ 'is-invalid': Carform.errors.has('marque') }" class="form-control">
                        <has-error :form="Carform" field="marque"></has-error>
                </div>
                <div class="form-group">
                    <input type="text" v-model="Carform.type" name="type" placeholder="Type du voiture" 
                        :class="{ 'is-invalid': Carform.errors.has('type') }" class="form-control">
                        <has-error :form="Carform" field="type"></has-error>
                </div>
                <div class="form-group">
                    <input type="text" v-model="Carform.annee" name="annee" placeholder="Année de fabrication" 
                        :class="{ 'is-invalid': Carform.errors.has('annee') }" class="form-control">
                        <has-error :form="Carform" field="annee"></has-error>
                </div>
                <div class="form-group">
                    <select id="type" v-model="Carform.dedouaner" name="dedouaner" placeholder="short" 
                        :class="{ 'is-invalid': Carform.errors.has('dedouaner') }" class="form-control">
                        <option value="">--Dedouaner--</option>
                        <option value="1">Oui</option>
                        <option value="0">Non</option>
                    </select>
                    <has-error :form="Carform" field="dedouaner"></has-error>
                </div>
                <div class="form-group">
                    <input type="number" v-model="Carform.prixDedouanement" name="prixDedouanement" placeholder="Prix du Dedouanement" 
                        :class="{ 'is-invalid': Carform.errors.has('prixDedouanement') }" class="form-control">
                        <has-error :form="Carform" field="prixDedouanement"></has-error>
                </div>
                <div class="form-group">
                    <input type="number" v-model="Carform.ht" name="ht" placeholder="Prix Hors Taxes" 
                        :class="{ 'is-invalid': Carform.errors.has('ht') }"  class="form-control">
                        <has-error :form="Carform" field="ht"></has-error>
                </div>
                <div class="form-group">
                    <input type="number" v-model="Carform.tva" name="tva" placeholder="Porcantage TVA %" 
                        :class="{ 'is-invalid': Carform.errors.has('tva') }" class="form-control">
                        <has-error :form="Carform" field="tva"></has-error>
                </div>
                <div class="form-group">
                    <textarea type="number" v-model="Carform.description" name="description" placeholder="Description du voiture" 
                        :class="{ 'is-invalid': Carform.errors.has('description') }" class="form-control"></textarea>
                        <has-error :form="Carform" field="description"></has-error>
                </div>
                <div class="form-group">
                    <vue-upload-multiple-image
                        @upload-success="uploadImageSuccess"
                        @before-remove="beforeRemove"
                        @edit-image="editImage" :data-images="images"
                        :maxImage="10"
                        dragText="Faites glisser des images (plusieurs)"
                        browseText="(ou) Sélectionnez"
                        primaryText="Défaut"
                        markIsPrimaryText="Définir par défaut"
                        popupText="Cette image sera affichée par défaut"
                        dropText="Déposez votre fichier ici ..."
                    ></vue-upload-multiple-image>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" @click="closeModalCar()" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add Car</button>
            </div>
            </form>
            </div>
        </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewLabel">Saisir les informations du client</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="invoice()">
                <div class="modal-body">
                    <div class="form-group">
                        <input v-model="form.name" type="text" name="name" placeholder="Nom" 
                        :class="{ 'is-invalid': form.errors.has('name') }" class="form-control">
                        <has-error :form="form" field="name"></has-error>
                    </div>
                    <div class="form-group">
                        <input v-model="form.email" type="email" name="email" placeholder="Email Adress"
                        :class="{ 'is-invalid': form.errors.has('email') }" class="form-control">
                        <has-error :form="form" field="email"></has-error>
                    </div>
                    <div class="form-group">
                        <input v-model="form.contact" type="text" name="contact" placeholder="Client Contact"
                        :class="{ 'is-invalid': form.errors.has('contact') }" class="form-control">
                        <has-error :form="form" field="contact"></has-error>
                    </div>
                    <div class="form-group">
                        <textarea v-model="form.bio" type="text" id="bio" name="bio" 
                        placeholder="short bio for Client (Opional)"
                        :class="{ 'is-invalid': form.errors.has('bio') }" class="form-control"></textarea>
                        <has-error :form="form" field="bio"></has-error>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-success">Valider l'achat</button>
                </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import VueUploadMultipleImage from 'vue-upload-multiple-image'

    export default {
        data() {
            return {
                slide: 0,
                sliding: null,
                proprietaire: null,
                cars: null,
                images: [],
                Carform: new Form({
                    user_id: '',
                    numserie: '',
                    marque: '',
                    type: '',
                    dedouaner: '',
                    prixDedouanement: null,
                    ht: null,
                    annee:'',
                    tva: null,
                    description: '',
                    images: null
                }),
                operationForm: new Form({
                    car_id: '',
                    type: '',
                    description: '',
                    montant: '',
                }),
                form: new Form({
                    car_id: '',
                    name: '',
                    email: '',
                    contact: '',
                    type: 'client',
                    bio: '',
                })
            }
        },
        components: {
            VueUploadMultipleImage
        },
        methods: {
            deleteCar(id){
                Swal.fire({
                    title: 'Vous êtes Sure ?',
                    text: "Vous voulez suppri,er cette voiture !",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Oui, Supprimer!'
                }).then((result) => {
                    if(result.value) {
                        //envoi request to server
                        this.form.delete('http://127.0.0.1:8000/api/car/'+id).then(() => {
                            Swal.fire(
                            'Supprimer!',
                            'Voiture à été supprimer.',
                            'success'
                            )
                            Fire.$emit('operationCreated');
                        }).catch(() => {
                            Swal.fire("Failed!", "THere was something wronge.", "warning");
                        })
                    }
                })
            },
            vendre(id){
                $('#addNew').modal('show');
                this.form.car_id=id;
            },
            invoice(){
                this.$Progress.start();
                this.form.post('http://127.0.0.1:8000/api/client')
                .then((data) => {
                    $('#addNew').modal('hide');
                    this.$Progress.finish();
                    Fire.$emit('operationCreated');
                    let routeData = this.$router.resolve({name: 'invoice', query: {car_id:this.form.car_id,user_id:data.data.user_id}});
                    window.open(routeData.href, '_blank');
                    this.form.reset();
                    this.form.clear();
                })
                .catch(() => {
                    this.$Progress.fail();
                })
            },
            closeModalCar(){
                this.Carform.reset();
                this.Carform.clear();
                this.images=[];
            },
            addCar(){
                this.Carform.user_id = this.proprietaire.id;
                this.$Progress.start();
                if(this.Carform.dedouaner == "0"){
                    this.Carform.prixDedouanement = 0;
                }
                this.Carform.post('http://127.0.0.1:8000/api/car')
                .then((data) => {
                    Fire.$emit('operationCreated');
                    Toast.fire({
                        icon: 'success',
                        title: 'Voiture ajouter avec succès'
                    });
                    this.Carform.reset();
                    this.Carform.clear();
                    this.images=[];
                    $('#exampleModal').modal('hide');
                    this.$Progress.finish();
                    let routeData = this.$router.resolve({name: 'achat', query: {car_id:data.data.car_id,user_id:data.data.user_id}});
                    window.open(routeData.href, '_self');
                })
                .catch(() => {
                    this.$Progress.fail();
                })
            },
            getProp(id){
                axios.get("http://127.0.0.1:8000/api/proprietaire/"+id).then(({ data }) => (this.proprietaire = data));
            },
            getCars(id){
                axios.get("http://127.0.0.1:8000/api/car/"+id).then(({ data }) => (this.cars = data));
            },
            getProfilePhoto(){
                return "http://127.0.0.1:8000/img/profile/"+this.proprietaire.photo;
            },
            onSlideStart(slide) {
                this.sliding = true
            },
            onSlideEnd(slide) {
                this.sliding = false
            },
            addOperation(id){
                this.$Progress.start();
                this.operationForm.car_id=id;
                this.operationForm.post('http://127.0.0.1:8000/api/operation')
                .then(() => {
                    Fire.$emit('operationCreated');
                    Toast.fire({
                        icon: 'success',
                        title: 'Operations ajouter avec succès'
                    });
                    this.operationForm.clear();
                    this.operationForm.reset();
                    this.$Progress.finish();
                })
                .catch(() => {
                    this.$Progress.fail();
                    this.operationForm.clear();
                })
            },
            uploadImageSuccess(formData, index, fileList) {
                // console.log('data', formData, index, fileList)
                this.Carform.images = fileList
                // Upload image api
                // axios.post('http://your-url-upload', formData).then(response => {
                //   console.log(response)
                // })
            },
            beforeRemove (index, done, fileList) {
                done()
                this.Carform.images = fileList
            },
            editImage (formData, index, fileList) {
                // console.log('edit data', formData, index, fileList)
            }
        },
        mounted() {
            this.getProp(this.$route.params.id);
            this.getCars(this.$route.params.id);
            Fire.$on('operationCreated', () => {
                this.getCars(this.$route.params.id);
                this.getCars(this.$route.params.id);
            });
        }
    }
</script>

<style>
.separator {
    display: flex;
    align-items: center;
    text-align: center;
}

.separator::before,
.separator::after {
    content: '';
    flex: 1;
    border-bottom: 1px solid rgba(66,133,244,.8);
    
}

.separator:not(:empty)::before {
    margin-right: .25em;
}

.separator:not(:empty)::after {
    margin-left: .25em;
}

hr {
    height: 4px;
    margin-left: 0px;
    margin-bottom:-3px;
}
.hr-primary{
    background-image: -webkit-linear-gradient(left, rgba(66,133,244,.8), rgba(66, 133, 244,.6), rgba(0,0,0,0));
}
.widget-user-header{
    background-position: center center;
    background-size: cover;
    height: 250px !important;
}
.widget-user .card-footer{
    padding: 0;
}

#body {
    background-color: #f9f9fa
}

.padding {
    padding: 3rem !important
}

.user-card-full {
    overflow: hidden
}

.card {
    border-radius: 5px;
    -webkit-box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
    box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
    border: none;
    margin-bottom: 30px
}

.m-r-0 {
    margin-right: 0px
}

.m-l-0 {
    margin-left: 0px
}

.user-card-full .user-profile {
    border-radius: 5px 0 0 5px
}

.bg-c-lite-green {
    background: -webkit-gradient(linear, left top, right top, from(#f29263), to(#ee5a6f));
    background: linear-gradient(to right, #ee5a6f, #f29263)
}

.user-profile {
    padding: 20px 0
}

.card-block {
    padding: 1.25rem
}

.m-b-25 {
    margin-bottom: 25px
}

.img-radius {
    border-radius: 5px
}

h6 {
    font-size: 14px
}

.card .card-block p {
    line-height: 25px
}

@media only screen and (min-width: 1400px) {
    p {
        font-size: 14px
    }
}

.card-block {
    padding: 1.25rem
}

.b-b-default {
    border-bottom: 1px solid #e0e0e0
}

.m-b-20 {
    margin-bottom: 20px
}

.p-b-5 {
    padding-bottom: 5px !important
}

.card .card-block p {
    line-height: 25px
}

.m-b-10 {
    margin-bottom: 10px
}

.text-muted {
    color: #919aa3 !important
}

.b-b-default {
    border-bottom: 1px solid #e0e0e0
}

.f-w-600 {
    font-weight: 600
}

.m-b-20 {
    margin-bottom: 20px
}

.m-t-40 {
    margin-top: 20px
}

.p-b-5 {
    padding-bottom: 5px !important
}

.m-b-10 {
    margin-bottom: 10px
}

.m-t-40 {
    margin-top: 20px
}

.user-card-full .social-link li {
    display: inline-block
}

.user-card-full .social-link li a {
    font-size: 20px;
    margin: 0 10px 0 0;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out
}
</style>