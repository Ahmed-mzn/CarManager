<template>
    <div>
        <div class="content-header" wfd-id="194">
            <div class="container-fluid" wfd-id="195">
                <div class="row mb-2" wfd-id="196">
                <div class="col-sm-6" wfd-id="200">
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div><!-- /.col -->
                    <div class="col-sm-6" wfd-id="197">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item" wfd-id="199"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" wfd-id="198">Dashboard v1</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content" wfd-id="7">
            <div class="container-fluid">
            <div class="row animate__animated animate__fadeInDown" wfd-id="179">
                <div class="col-lg-3 col-6" wfd-id="192">
                    <!-- small box -->
                    <div class="small-box bg-info" wfd-id="193">
                    <div class="inner" wfd-id="195">
                        <h3>{{countOrders}}</h3>

                        <p>New Orders</p>
                    </div>
                    <div class="icon" wfd-id="194">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <a href="http://127.0.0.1:8000/proprietaire" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6" wfd-id="188">
                    <!-- small box -->
                    <div class="small-box bg-success" wfd-id="189">
                    <div class="inner" wfd-id="191">
                        <h3>{{countCars}}</h3>

                        <p>Voitures</p>
                    </div>
                    <div class="icon" wfd-id="190">
                        <i class="fa fa-car"></i>
                    </div>
                    <a href="http://127.0.0.1:8000/cars" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6" wfd-id="184">
                    <!-- small box -->
                    <div class="small-box bg-warning" wfd-id="185">
                    <div class="inner" wfd-id="187">
                        <h3>{{countUsers}}</h3>

                        <p>Utilisateurs </p>
                    </div>
                    <div class="icon mx-4 px-4" wfd-id="186">
                        <i class="fa fa-users fa-5x"></i>
                    </div>
                    <a href="http://127.0.0.1:8000/users" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6" wfd-id="180">
                    <!-- small box -->
                    <div class="small-box bg-danger" wfd-id="181">
                    <div class="inner" wfd-id="183">
                        <h3>{{countOperations}}</h3>

                        <p>Car Operations</p>
                    </div>
                    <div class="icon" wfd-id="182">
                        <i class="fa fa-cog"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                </div>
            </div>
<div class="row" wfd-id="7">
          <!-- Left col -->
          <div class="col-md-8" wfd-id="78">
            <!-- MAP & BOX PANE -->
            <div class="card animate__animated animate__fadeInUp" wfd-id="181">
              <div class="card-header" wfd-id="201">
                <h3 class="card-title">Statistique Sur Les marques Des voitures</h3>

                <div class="card-tools" wfd-id="202">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" wfd-id="378">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove" wfd-id="377">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0" wfd-id="182">
                <div class="d-md-flex" wfd-id="183">
                  <div class="p-1 flex-fill" style="overflow: hidden" wfd-id="194">
                    <canvas id="myChart" width="300" height="200"></canvas>
                  </div>
                </div><!-- /.d-md-flex -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="row animate__animated animate__fadeInUp" wfd-id="99">

              <div class="col-md-12" wfd-id="100">
                <!-- USERS LIST -->
                <div class="card" wfd-id="101">
                  <div class="card-header" wfd-id="121">
                    <h3 class="card-title">Graphique en anneau sur l'etat des voitures</h3>

                    <div class="card-tools" wfd-id="122">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse" wfd-id="372"><i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove" wfd-id="371"><i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body" wfd-id="103">
                    <div class="row justify-content-center">
                      <div class="col-md-8">
                        <canvas id="doughnut-chart"></canvas>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer bg-white p-0" wfd-id="36">
                    <ul class="nav nav-pills flex-column" wfd-id="37">
                      <li class="nav-item" wfd-id="42">
                        <a href="#" class="nav-link">
                          Suppression des Voitures de la Bouressa
                          <span class="float-right text-danger" wfd-id="43">
                            <i class="fas fa-arrow-down text-sm"></i>
                            12%</span>
                        </a>
                      </li>
                      <li class="nav-item" wfd-id="40">
                        <a href="#" class="nav-link">
                          Acquisition des voitures
                          <span class="float-right text-success" wfd-id="41">
                            <i class="fas fa-arrow-up text-sm"></i> 4%
                          </span>
                        </a>
                      </li>
                      <li class="nav-item" wfd-id="38">
                        <a href="#" class="nav-link">
                          Ventes des voitures
                          <span class="float-right text-warning" wfd-id="39">
                            <i class="fas fa-arrow-left text-sm"></i> 0%
                          </span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <!--/.card -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- TABLE: LATEST ORDERS -->
            <div class="card animate__animated animate__fadeInUp" wfd-id="79">
              <div class="card-header border-transparent" wfd-id="97">
                <h3 class="card-title">Dernières Factures</h3>

                <div class="card-tools" wfd-id="98">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" wfd-id="370">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove" wfd-id="369">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0" wfd-id="81">
                <div class="table-responsive" wfd-id="82">
                  <table class="table m-0">
                    <thead>
                      <tr>
                        <th>Facture ID</th>
                        <th>Car</th>
                        <th>Status</th>
                        <th>Client</th>
                        <th>Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="order in orders" :key="order.id">
                        <td><a href="#">OR000{{order.id}}</a></td>
                        <td>{{order.car.marque +" | "+order.car.type+" | "+order.car.annee | uper}}</td>
                        <td><span class="badge badge-success" wfd-id="96">Payé</span></td>
                        <td>
                          <div class="sparkbar" data-color="#00a65a" data-height="20" wfd-id="95">{{order.user.name | uperText}}</div>
                        </td>
                        <td>{{order.created_at | myDate}}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix" wfd-id="80">
                <a href="http://127.0.0.1:8000/proprietaire" class="btn btn-sm btn-info float-left">Etablir Nouveau facture</a>
                <a href="#" class="btn btn-sm btn-secondary float-right">Voir toutes les fatcures</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <div class="col-md-4" wfd-id="8">
            <!-- Info Boxes Style 2 -->
            <div class="info-box mb-3 bg-warning animate__animated animate__fadeInRight" wfd-id="73">
              <span class="info-box-icon" wfd-id="77"><i class="fas fa-tag"></i></span>

              <div class="info-box-content" wfd-id="74">
                <span class="info-box-text" wfd-id="76">Invoices</span>
                <span class="info-box-number" wfd-id="75">{{invoices}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-success animate__animated animate__fadeInRight" wfd-id="68">
              <span class="info-box-icon" wfd-id="72"><i class="fab fa-btc"></i></span>

              <div class="info-box-content" wfd-id="69">
                <span class="info-box-text" wfd-id="71">Fonds</span>
                <span class="info-box-number" wfd-id="70">{{fonds | Currency}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-danger animate__animated animate__fadeInRight" wfd-id="63">
              <span class="info-box-icon" wfd-id="67"><i class="fas fa-cloud-upload-alt"></i></span>

              <div class="info-box-content" wfd-id="64">
                <span class="info-box-text" wfd-id="66">Uploads Photos</span>
                <span class="info-box-number" wfd-id="65">{{countPhoto}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-info animate__animated animate__fadeInRight" wfd-id="58">
              <span class="info-box-icon" wfd-id="62"><i class="fa fa-check-circle"></i></span>

              <div class="info-box-content" wfd-id="59">
                <span class="info-box-text" wfd-id="61">Acquisition Voitures</span>
                <span class="info-box-number" wfd-id="60">{{acquisCars}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->

            <div class="card animate__animated animate__fadeInRight" wfd-id="35">
              <div class="card-header" wfd-id="56">
                <h3 class="card-title">Dernières utilisateurs</h3>

                <div class="card-tools" wfd-id="57">
                  <span class="badge badge-danger" wfd-id="58">8 New</span>
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" wfd-id="368"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove" wfd-id="367"><i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0" wfd-id="44">
                  <ul class="users-list clearfix" wfd-id="104">
                    <li v-for="user in users" :key="user.id" wfd-id="119">
                      <img v-if="user.photo!='profile.png'" :src="'http://127.0.0.1:8000/img/profile/'+user.photo" alt="User Image">
                      <img v-if="user.photo=='profile.png'" :src="'http://127.0.0.1:8000/img/profile.png'" alt="User Image">
                      <a class="users-list-name" :href="'http://127.0.0.1:8000/proprietaire/'+user.id">{{user.name}}</a>
                      <span class="users-list-date" wfd-id="120">{{user.created_at | myDate}}</span>
                    </li>
                  </ul>
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-center" wfd-id="36">
                <a href="http://127.0.0.1:8000/users">Voir tout les utilisateurs</a>
              </div>
              <!-- /.footer -->
            </div>
            <!-- /.card -->

            <!-- PRODUCT LIST -->
            <div class="card animate__animated animate__fadeInRight" wfd-id="9">
              <div class="card-header" wfd-id="33">
                <h3 class="card-title">Voitures recent ajouté</h3>

                <div class="card-tools" wfd-id="34">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" wfd-id="366">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove" wfd-id="365">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0" wfd-id="11">
                <ul class="products-list product-list-in-card pl-2 pr-2" wfd-id="12">
                  <li v-for="car in cars" :key="car.id" class="item" wfd-id="28">
                    <div class="product-img" wfd-id="32">
                      <img :src="'http://127.0.0.1:8000/img/cars/'+car.id+'/'+car.photos[0].photo" alt="Product Image" class="img-size-50 rounded">
                    </div>
                    <div class="product-info" wfd-id="29">
                      <a :href="'http://127.0.0.1:8000/cars/'+car.id" class="product-title">{{car.marque+" "+car.type | uper}}
                        <span class="badge badge-success float-right" wfd-id="31">{{car.ht | Currency}} MRU</span></a>
                      <span class="product-description" wfd-id="30">
                        {{car.description}}
                      </span>
                    </div>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-center" wfd-id="10">
                <a href="http://127.0.0.1:8000/cars" class="uppercase">Voir tout les Voitures</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->

            <!-- PRODUCT LIST -->
            <div class="card animate__animated animate__fadeInRight" wfd-id="9">
              <div class="card-header" wfd-id="33">
                <h3 class="card-title">Recent Operations</h3>

                <div class="card-tools" wfd-id="34">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" wfd-id="366">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove" wfd-id="365">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0" wfd-id="11">
                <ul class="products-list product-list-in-card pl-2 pr-2" wfd-id="12">
                  <li v-for="op in operations" :key="op.id" class="item" wfd-id="28">
                    <div class="product-img" wfd-id="32">
                      <img src="http://127.0.0.1:8000/img/service.png" alt="Product Image" class="img-size-50">
                    </div>
                    <div class="product-info" wfd-id="29">
                      <a href="#" class="product-title">{{op.type}}
                        <span class="badge badge-success float-right" wfd-id="31">{{op.montant | Currency}} MRU</span></a>
                      <span class="product-description" wfd-id="30">
                        {{op.description}}
                      </span>
                    </div>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-center" wfd-id="10">
                <a href="#" class="uppercase">View All Operations</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        </section>
    </div>
</template>

<script>
import {
  Chart,
  ArcElement,
  LineElement,
  BarElement,
  PointElement,
  BarController,
  BubbleController,
  DoughnutController,
  LineController,
  PieController,
  PolarAreaController,
  RadarController,
  ScatterController,
  CategoryScale,
  LinearScale,
  LogarithmicScale,
  RadialLinearScale,
  TimeScale,
  TimeSeriesScale,
  Decimation,
  Filler,
  Legend,
  Title,
  Tooltip
} from 'chart.js';

Chart.register(
  ArcElement,
  LineElement,
  BarElement,
  PointElement,
  BarController,
  BubbleController,
  DoughnutController,
  LineController,
  PieController,
  PolarAreaController,
  RadarController,
  ScatterController,
  CategoryScale,
  LinearScale,
  LogarithmicScale,
  RadialLinearScale,
  TimeScale,
  TimeSeriesScale,
  Decimation,
  Filler,
  Legend,
  Title,
  Tooltip
);
    export default {
        data(){
            return {
              cars:null,
              users:null,
              operations:null,
              orders:null,
              countUsers:null,
              countCars:null,
              countOperations:null,
              countOrders:null,
              countPhoto:null,
              fonds:null,
              invoices:null,
              acquisCars:null,
              countMarque:null,
              chartjs:null,
              marque:[],
              nbMarque:[],
            }
        },
        methods:{
          loadUsers(){
            axios.get("api/user").then(({ data }) => (this.users = data.data));
          },
          loadCars(){
            axios.get("http://127.0.0.1:8000/api/car").then(({ data }) => (this.cars = data.data));
          },
          loadOperations(){
            axios.get("http://127.0.0.1:8000/api/operation").then(({ data }) => (this.operations = data.data));
          },
          loadOrders(){
            axios.get("api/achat").then(({ data }) => (this.orders = data.data));
          },
          loadCountUser(){
            axios.get("http://127.0.0.1:8000/api/count")
            .then((data) => {
                this.countUsers = data.data.users
                this.countCars = data.data.cars
                this.countOperations = data.data.operations
                this.countOrders = data.data.achats
                this.countPhoto = data.data.photos
                this.fonds = data.data.sumht
                this.invoices = data.data.invoices
                this.acquisCars = data.data.acquisCars
                this.countMarque = data.data.countMarque
                this.chartjs = data.data.chartjs
                Fire.$emit('now');
            })
          },
          getMarqueCount(){
            for (let i=0; i< this.countMarque.length; i++){
              this.marque.push(this.countMarque[i].marque);
              this.nbMarque.push(this.countMarque[i].marque_count);
            }
          },
          getMarque(){
            var ctx = document.getElementById('myChart');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: this.marque,
                    datasets: [{
                        label: 'Nombre de voiture par marque',
                        data: this.nbMarque,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            new Chart(document.getElementById("doughnut-chart"), {
                type: 'doughnut',
                data: {
                  labels: ["Vendu", "Acquis", "Supprimer"],
                  datasets: [
                    {
                      label: "Statistiques sur les voitures",
                      backgroundColor: ["#ffcd56", "#3e95cd","#ff6384"],
                      data: this.chartjs
                    }
                  ]
                },
                options: {
                  responsive: true,
                  plugins: {
                    legend: {
                      position: 'top',
                    },
                    title: {
                      display: true,
                      text: 'Estimations Sur les voitures'
                    }
                  }
                }
            });
          }
        },
        mounted() {
          this.loadCountUser();
          this.loadCars();
          this.loadOperations();
          this.loadUsers();
          this.loadOrders();
          Fire.$on('now', () => {
            this.getMarqueCount();
            this.getMarque();
          });

        }
    }
</script>