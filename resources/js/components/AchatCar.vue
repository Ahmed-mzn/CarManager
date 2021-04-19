<template>
    <div class="container">
        <div class="row justify-content-center" id="ads">
            <div class="invoice p-3 mb-3" wfd-id="9">
                <!-- title row -->
                <div class="row" wfd-id="22">
                    <div class="col-12" wfd-id="23">
                    <h4>
                        <i class="fas fa-car"></i> BouressaTi, Inc.
                        <small class="float-right">{{dateNow | myDate}}</small>
                    </h4>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info" wfd-id="18">
                    <div class="col-sm-4 invoice-col" wfd-id="21">
                    From
                    <address>
                        <strong>BouressaTi, Inc.</strong><br>
                        795 Rue Al Quds, Appt 600<br>
                        Tevragh Zeina, ZRA 94107<br>
                        Phone: +222 45.25.01.02<br>
                        Email: info@bouressati.com
                    </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col" wfd-id="20">
                    Client Info
                    <address>
                        <strong>{{client.name | uperText}}</strong><br>
                        {{client.bio}}<br>
                        Phone: {{client.contact}}<br>
                        Email: {{client.email}}
                    </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col" wfd-id="19">
                    <b>Invoice #007612</b><br>
                    <br>
                    <b>Order ID:</b> 4F3S8J<br>
                    <b>Payment Due:</b> 2/22/2014<br>
                    <b>Account:</b> 968-34567
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <center><h2 class="mb-4"><b><u>Acquisition Voiture</u></b></h2></center>
                <!-- Table row -->
                <div class="row justify-content-center mt-3 mb-3" wfd-id="16">
                    <div class="col-10 table-responsive" wfd-id="17">
                        <table class="table table-striped">
                            <thead>
                                <tr scope="col"><th colspan="2"><center>Informations du voiture</center></th></tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Numero chassis</th>
                                    <td>{{car.numserie}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Marque</th>
                                    <td>{{car.marque | uper}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Type</th>
                                    <td>{{car.type | uper}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Année</th>
                                    <td>{{car.annee}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Description</th>
                                    <td>{{car.description}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Dedouaner</th>
                                    <td>{{car.dedouaner ? 'oui': 'non'}}</td>
                                </tr>
                                <tr v-if="car.dedouaner">
                                    <th scope="row">Prix dedouanement</th>
                                    <td>{{car.prixDedouanement | Currency}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row" wfd-id="12">
                    <!-- accepted payments column -->
                    <div class="col-6" wfd-id="15">
                    <p class="lead">Payment Methods:</p>
                    <img src="/img/visa.png" alt="Visa">
                    <img src="/img/mastercard.png" alt="Mastercard">
                    <img src="/img/paypal2.png" alt="Paypal">
                    <b class="badge badge-pill badge-success">CASH</b>
                    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                        plugg
                        dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                    </p>
                    </div>
                    <!-- /.col -->
                    <div class="col-6" wfd-id="13">
                    <p class="lead">Amount Due 2/22/2014</p>

                    <div class="table-responsive" wfd-id="14">
                        <table class="table">
                        <tbody>
                        <tr v-if="car.dedouaner">
                            <th>Prix Dedouanement :</th>
                            <td>{{car.prixDedouanement | Currency}} MRU</td>
                        </tr>
                        <tr>
                            <th>Prix TTC:</th>
                            <td>{{car.ttc - car.ht+(car.ht*(car.tva/100)) | Currency}} MRU</td>
                        </tr>
                        </tbody></table>
                    </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- this row will not appear when printing -->
                <div class="row no-print" wfd-id="10">
                    <div class="col-12" wfd-id="11">
                    <a href="#" @click="print()" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                    <button type="button" class="btn btn-success float-right" wfd-id="110"><i class="far fa-credit-card"></i> Submit
                        Payment
                    </button>
                    <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;" wfd-id="109">
                        <i class="fas fa-download"></i> Generate PDF
                    </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            dateNow: new Date(),
            client:null,
            car: null,
        }
    },
    methods: {
        print(){
            window.print()
        },
        carInfo(id){
            axios.get("http://127.0.0.1:8000/api/getCar/"+id)
            .then(( data ) => {
                console.log(data)
                this.car = data.data.car
            });
        },
        clientInfo(id){
            axios.get("http://127.0.0.1:8000/api/proprietaire/"+parseInt(id)).then(({ data }) => (this.client = data));
        },
    },
    mounted(){
        this.carInfo(this.$route.query.car_id)
        this.clientInfo(this.$route.query.user_id)
    }
}
</script>