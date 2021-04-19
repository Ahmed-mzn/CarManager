<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard Component</div>

                    <div class="card-body">
                        I'm an dashboard component. <button @click="test()">Clicked</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                car: new Form({
                    user_id: '2',
                    numserie: '3rd3',
                    marque: 'toyota',
                    type: 'V8',
                    statut:'en stock',
                    dedouaner: 1,
                    prixDedouanement: 1000,
                    ht: 100,
                    annee:'2020',
                    tva: 10,
                    description: 'nothing',
                })
            }
        },
        methods:{
            test(){
                this.$Progress.start();
                this.car.post('api/car')
                .then((data) => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Voiture ajouter avec succès'
                    });
                    this.$Progress.finish();
                    console.log(data)
                })
                .catch(() => {
                    this.$Progress.fail();
                })
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
