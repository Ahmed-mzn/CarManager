<template>
    <div class="container">
        <div class="row" wfd-id="23">
            <div class="col-12 mt-5" wfd-id="24">
                <div class="card" wfd-id="25">
                <div class="card-header" wfd-id="31">
                    <h3 class="card-title">Table de Proprietaire</h3>
                    <div class="card-tools" wfd-id="32">
                        <button class="btn btn-success" @click="newModal">
                            Add New <i class="fa fa-user-plus fa-fw"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" wfd-id="26">
                    <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Registered At</th>
                            <th>Modifier</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="pro in proprietaires.data" :key="pro.id">
                            <td>{{pro.id}}</td>
                            <td>{{pro.name | uperText}}</td>
                            <td>{{pro.email}}</td>
                            <td>{{pro.contact}}</td>
                            <td>{{pro.created_at | myDate}}</td>
                            <td>
                                <a href="#" @click="editModal(pro)"><i class="fas fa-edit blue"></i></a>/
                                <a href="#" @click="deleteUser(pro.id)"><i class="fas fa-trash red"></i></a>
                            </td>
                            <td>
                                <router-link @click="details(pro)" class="btn btn-sm btn-outline-info" 
                                :to="'/proprietaire/' + pro.id">
                                    <i class="fas fa-angle-double-right"></i> Details
                                </router-link>
                            </td>
                        </tr>
                    </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 v-show="editmode" class="modal-title" id="addNewLabel">Modifier Utilisateur informations</h5>
                    <h5 v-show="!editmode" class="modal-title" id="addNewLabel">Ajouter Utilisateur</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="editmode ? updateUser() : createUser()">
                <div class="modal-body">
                    <div class="form-group">
                        <input v-model="form.name" type="text" name="name" placeholder="Name" 
                        :class="{ 'is-invalid': form.errors.has('name') }" class="form-control">
                        <has-error :form="form" field="name"></has-error>
                    </div>
                    <div class="form-group">
                        <input v-model="form.email" type="email" name="email" placeholder="Email Adress"
                        :class="{ 'is-invalid': form.errors.has('email') }" class="form-control">
                        <has-error :form="form" field="email"></has-error>
                    </div>
                    <div class="form-group">
                        <input v-model="form.contact" type="text" name="contact" placeholder="User Contact"
                        :class="{ 'is-invalid': form.errors.has('contact') }" class="form-control">
                        <has-error :form="form" field="contact"></has-error>
                    </div>
                    <div class="form-group">
                        <textarea v-model="form.bio" type="text" id="bio" name="bio" 
                        placeholder="short bio for user (Opional)"
                        :class="{ 'is-invalid': form.errors.has('bio') }" class="form-control"></textarea>
                        <has-error :form="form" field="bio"></has-error>
                    </div>
                    <div class="form-group">
                        <input type="file" @change="updateProfile" name="photo" class="form-input">
                        <has-error :form="form" field="photo"></has-error>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
                    <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
                </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                editmode : false,
                proprietaires: {},
                form: new Form({
                    id: '',
                    name: '',
                    email: '',
                    contact: '',
                    bio: '',
                    photo: ''
                })
            }
        },
        methods: {
            details(proprietraire){
                Fire.$emit('details',proprietraire);
                this.details = true;
            },
            loadUsers(){
                axios.get("api/proprietaire").then(({ data }) => (this.proprietaires = data));
            },
            editModal(user){
                this.editmode = true;
                this.form.reset();
                this.form.clear();
                $('#addNew').modal('show');
                this.form.fill(user);
            },
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },
            deleteUser(id){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if(result.value) {
                        //envoi request to server
                        this.form.delete('api/proprietaire/'+id).then(() => {

                            Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                            )
                            Fire.$emit('AfterCreate');
                        }).catch(() => {
                            Swal.fire("Failed!", "THere was something wronge.", "warning");
                        })
                    }
                })
            },
            updateProfile(e){
                let file = e.target.files[0];
                // console.log(file);
                let reader = new FileReader();
                if(file['size'] < 2111775){
                    reader.onloadend = (file) => {
                        // console.log('RESLUT', reader.result)
                        this.form.photo = reader.result;
    
                    }
                    reader.readAsDataURL(file);
                }else{
                    Swal.fire({
                        title: 'Ooops!',
                        text: "Your are uploading a large file",
                        icon: 'error',
                    });
                }
            },
            updateUser(){
                this.$Progress.start();
                this.form.put('api/proprietaire/'+this.form.id)
                .then(() => {
                    $('#addNew').modal('hide');
                    Swal.fire(
                    'Updated!',
                    'Your infomations has been updated.',
                    'success'
                    )
                    this.$Progress.finish();
                    Fire.$emit('AfterCreate');
                })
                .catch(() => {
                    this.$Progress.fail();
                });
            },
            createUser(){
                this.$Progress.start();
                this.form.post('api/proprietaire')
                .then(() => {
                    Fire.$emit('AfterCreate');
                    $('#addNew').modal('hide');
                    Toast.fire({
                        icon: 'success',
                        title: 'Utilisateur Créer avec succès'
                    });
                    this.$Progress.finish();
                })
                .catch(() => {
                    this.$Progress.fail();
                })
            }
        },
        mounted() {
            this.loadUsers();
        }
    }
</script>
