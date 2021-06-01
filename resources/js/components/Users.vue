<template>
    <div class="container">
        <div class="row" wfd-id="23">
            <div class="col-md-12  mt-5" wfd-id="24">
                <div class="card" wfd-id="25">
                <div class="card-header" wfd-id="31">
                    <h3 class="card-title">Tabe des utilisateurs</h3>

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
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Type</th>
                            <th>Registered At</th>
                            <th>Modifier</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in users.data" :key="user.id">
                            <td>{{user.id}}</td>
                            <td>{{user.name | uperText}}</td>
                            <td>{{user.email}}</td>
                            <td>{{user.contact}}</td>
                            <td>{{user.type | uperText}}</td>
                            <td>{{user.created_at | myDate}}</td>
                            <td>
                                <a href="#" @click="editModal(user)"><i class="fas fa-edit blue"></i></a>/
                                <a href="#" @click="deleteUser(user.id)"><i class="fas fa-trash red"></i></a>
                            </td>
                        </tr>
                    </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
               <div class="card-footer">
                    <pagination v-if="!searching" :data="users" @pagination-change-page="getResults">
                    	<span slot="prev-nav">&lt; Précédent</span>
	                    <span slot="next-nav">Suivant &gt;</span>
                    </pagination>
                    <pagination v-if="searching" :data="users" @pagination-change-page="getResultsSearch">
                    	<span slot="prev-nav">&lt; Précédent</span>
	                    <span slot="next-nav">Suivant &gt;</span>
                    </pagination>
                </div>
                </div>
                
            </div>
        </div>

        <!-- <not-found v-if="!$gate.isAdmin() && !$gate.isAuthor()"></not-found> -->

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
                        <input v-model="form.name" type="text" name="name" placeholder="Nom" 
                        :class="{ 'is-invalid': form.errors.has('name') }" class="form-control">
                        <has-error :form="form" field="name"></has-error>
                    </div>
                    <div class="form-group">
                        <input v-model="form.email" type="email" name="email" placeholder="Email Adresse"
                        :class="{ 'is-invalid': form.errors.has('email') }" class="form-control">
                        <has-error :form="form" field="email"></has-error>
                    </div>
                    <div class="form-group">
                        <input v-model="form.contact" type="text" name="contact" placeholder="Utilisateur Contact"
                        :class="{ 'is-invalid': form.errors.has('contact') }" class="form-control">
                        <has-error :form="form" field="contact"></has-error>
                    </div>
                    <div class="form-group">
                        <textarea v-model="form.bio" type="text" id="bio" name="bio" 
                        placeholder="Description de l'utilisateur (Opitionnel)"
                        :class="{ 'is-invalid': form.errors.has('bio') }" class="form-control"></textarea>
                        <has-error :form="form" field="bio"></has-error>
                    </div>
                    <div class="form-group">
                        <select v-model="form.type" id="type" name="type" placeholder="short"
                        :class="{ 'is-invalid': form.errors.has('type') }" class="form-control">
                            <option value="">Choisir User Role</option>
                            <option value="admin">Admin</option>
                            <option value="client">Client</option>
                            <option value="comptable">Comptable</option>
                            <option value="proprietaire">Proprietaire</option>
                        </select>
                        <has-error :form="form" field="type"></has-error>
                    </div>
                    <div class="form-group">
                        <input v-model="form.password" type="password" id="password" name="password" placeholder="Password"
                        :class="{ 'is-invalid': form.errors.has('password') }" class="form-control">
                        <has-error :form="form" field="password"></has-error>
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
                searching: false,
                editmode : false,
                users: {},
                form: new Form({
                    id: '',
                    name: '',
                    email: '',
                    contact: '',
                    password: '',
                    type: '',
                    bio: '',
                    photo: ''
                })
            }
        },
        methods: {
            getResults(page = 1) {
                axios.get('api/user?page=' + page)
                    .then(response => {
                        this.users = response.data;
                    });
            },
            getResultsSearch(page = 1) {
                let query = this.$parent.search;
                axios.get('api/findUser?q='+query+'&page=' + page)
                    .then(response => {
                        this.users = response.data;
                    });
            },
            updateUser(){
                this.$Progress.start();
                this.form.put('api/user/'+this.form.id)
                .then(() => {
                    $('#addNew').modal('hide');
                    Swal.fire(
                    'Modifier!',
                    'Informations modifier avec success.',
                    'success'
                    )
                    this.$Progress.finish();
                    Fire.$emit('AfterCreate');
                })
                .catch(() => {
                    this.$Progress.fail();
                });
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
                    title: 'Vous êtes sûr?',
                    text: "Provoque la suppression définitivement!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Oui, supprimer!'
                }).then((result) => {
                    if(result.value) {
                        //envoi request to server
                        this.form.delete('api/user/'+id).then(() => {

                            Swal.fire(
                            'Supprimer!',
                            'Utilisateru à été supprimer.',
                            'success'
                            )
                            Fire.$emit('AfterCreate');
                        }).catch(() => {
                            Swal.fire("Failed!", "There was something wronge.", "warning");
                        })
                    }
                })
            },
            loadUsers(){
                axios.get("api/user").then(({ data }) => (this.users = data));
            },
            createUser(){
                this.$Progress.start();
                this.form.post('api/user')
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
        created() {
            this.loadUsers();
            Fire.$on('AfterCreate', () => {
                this.loadUsers();
            });

            Fire.$on('searching', () => {
                this.searching = true;
                let query = this.$parent.search;
                axios.get('api/findUser?q='+query)
                .then((data) => {
                    this.users = data.data;
                })
                .catch(() => {

                });
            });
        }
    }
</script>
