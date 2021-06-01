<template>
    <transition
        enter-active-class="animate__animated animate__fadeIn"
        leave-active-class="animate__animated animate__fadeOut">
        <div class="container animate__animated animate__fadeIn">
            <div v-for="car in cars" :key="car.id" class="row justify-content-center" id="ads">
                <div class="col-md-8">
                    <div class="card rounded">
                        <div class="card-image mb-2">
                            <span v-if="car.dedouaner == '1'" class="card-notify-badge">Dedouaner</span>
                            <span v-if="car.dedouaner == '0'" class="card-notify-badge">Non Dedouaner</span>
                            <span class="card-notify-year">{{car.annee}}</span>
                            <center><img class="img-fluid" :src="'http://127.0.0.1:8000/img/cars/' + car.id + '/' + car.photos[0].photo" alt="Alternate Text" /></center>
                        </div>
                        <div class="card-image-overlay m-auto">
                            <span class="card-detail-badge">{{car.marque}}</span>
                            <span class="card-detail-badge">{{car.ht | Currency}} MRU</span>
                            <span class="card-detail-badge">{{car.created_at | moment}}</span>
                        </div>
                        <div class="card-body text-center">
                            <div class="ad-title m-auto">
                                <h5>{{car.marque+" "+car.type | uper}}</h5>
                            </div>
                            <router-link class="ad-btn" :to="'/cars/' + car.id">View</router-link>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <pagination :data="cars" @pagination-change-page="getResults">
                    <span slot="prev-nav">&lt; Précédent</span>
                    <span slot="next-nav">Suivant &gt;</span>
                </pagination>
            </div>
        </div>
    </transition>
</template>

<script>


export default {
    data() {
        return {
            cars:{},
        }
    },
    methods: {
        getResults(page = 1) {
            axios.get('http://127.0.0.1:8000/api/car?page=' + page)
                .then(response => {
                    this.cars = response.data;
                });
        },
        loadCars(){
            axios.get("http://127.0.0.1:8000/api/car").then(({ data }) => (this.cars = data.data));
        },
    },
    mounted() {
        this.loadCars();
        Fire.$on('searching', () => {
            let query = this.$parent.search;
            axios.get('api/findCar?q='+query)
            .then((data) => {
                this.cars = data.data.data;
            })
            .catch(() => {

            });
        });
    }
}
</script>

<style>

/* Category Ads */



#ads .card-notify-badge {
        position: absolute;
        left: -10px;
        top: -20px;
        background: #f2d900;
        text-align: center;
        border-radius: 30px 30px 30px 30px; 
        color: #000;
        padding: 5px 10px;
        font-size: 14px;

    }

#ads .card-notify-year {
        position: absolute;
        right: -10px;
        top: -20px;
        background: #ff4444;
        border-radius: 50%;
        text-align: center;
        color: #fff;      
        font-size: 14px;      
        width: 50px;
        height: 50px;    
        padding: 15px 0 0 0;
}


#ads .card-detail-badge {      
        background: #f2d900;
        text-align: center;
        border-radius: 30px 30px 30px 30px;
        color: #000;
        padding: 5px 10px;
        font-size: 14px;        
    }

   

#ads .card:hover {
            background: #fff;
            box-shadow: 12px 15px 20px 0px rgba(46,61,73,0.15);
            border-radius: 4px;
            transition: all 0.3s ease;
        }

#ads .card-image-overlay {
        font-size: 20px;
        
    }


#ads .card-image-overlay span {
            display: inline-block;              
        }


#ads .ad-btn {
        text-transform: uppercase;
        width: 150px;
        height: 40px;
        border-radius: 80px;
        font-size: 16px;
        line-height: 35px;
        text-align: center;
        border: 3px solid #e6de08;
        display: block;
        text-decoration: none;
        margin: 20px auto 1px auto;
        color: #000;
        overflow: hidden;        
        position: relative;
        background-color: #e6de08;
    }

#ads .ad-btn:hover {
            background-color: #e6de08;
            color: #1e1717;
            border: 2px solid #e6de08;
            background: transparent;
            transition: all 0.3s ease;
            box-shadow: 12px 15px 20px 0px rgba(46,61,73,0.15);
        }

#ads .ad-title h5 {
        text-transform: uppercase;
        font-size: 18px;
    }
    
</style>