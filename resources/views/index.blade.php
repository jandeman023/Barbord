@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card shopping-cart">
                    <div class="card-header bg-dark text-light">
                        <i class="fa fa-user-friends" aria-hidden="true"></i>
                        Personen
                        <div class="clearfix"></div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-4">
                                <button class="btn btn-lg btn-dark btn-block">Explos</button>
                            </div>
                            <div class="col-xl-4">
                                <button class="btn btn-lg btn-dark btn-block">Rovers</button>
                            </div>
                            <div class="col-xl-4">
                                <button class="btn btn-lg btn-dark btn-block">Stam</button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-6 col-xl-4 pb-3">
                                <button class="btn btn-lg btn-dark btn-block">Jan</button>
                            </div>
                            <div class="col-lg-6 col-xl-4 pb-3">
                                <button class="btn btn-lg btn-dark btn-block">Sanna</button>
                            </div>
                            <div class="col-lg-6 col-xl-4 pb-3">
                                <button class="btn btn-lg btn-dark btn-block">Daan</button>
                            </div>
                            <div class="col-lg-6 col-xl-4 pb-3">
                                <button class="btn btn-lg btn-dark btn-block">Jordy</button>
                            </div>
                            <div class="col-lg-6 col-xl-4 pb-3">
                                <button class="btn btn-lg btn-dark btn-block">Klaas</button>
                            </div>
                            <div class="col-lg-6 col-xl-4 pb-3">
                                <button class="btn btn-lg btn-dark btn-block">Samantha</button>
                            </div>
                            <div class="col-lg-6 col-xl-4 pb-3">
                                <button class="btn btn-lg btn-dark btn-block">Pieterson</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shopping-cart">
                    <div class="card-header bg-dark text-light">
                        <i class="fa fa-utensils" aria-hidden="true"></i>
                        Producten
                        <div class="clearfix"></div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 pb-3">
                                <button class="btn btn-lg btn-dark btn-block"><i class="fa fa-beer"></i> Hertog Jan<br>€0.70</button>
                            </div>
                            <div class="col-md-4 pb-3">
                                <button class="btn btn-lg btn-dark btn-block"><i class="fa fa-cookie-bite"></i> Snicker<br>€1.20</button>
                            </div>
                            <div class="col-md-4 pb-3">
                                <button class="btn btn-lg btn-dark btn-block"><i class="fa fa-beer"></i> Grols<br>€0.70</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shopping-cart">
                    <div class="card-header bg-dark text-light">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        Winkelmand
                        <div class="clearfix"></div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 pb-3">
                                <h3>Je streept voor:</h3>
                            </div>
                        </div>
                        <div class="row d-flex h-100">
                            <div class="col-12 text-sm-center col-sm-12 text-md-left col-md-8 justify-content-center align-self-center">
                                <h5 class="product-name"><strong>Jan</strong></h5>
                            </div>
                            <div class="col-md-2 text-center justify-content-center align-self-center">
                                Saldo:<br><b>€24,50</b>
                            </div>
                            <div class="col-2 col-sm-2 col-md-2 text-right justify-content-center align-self-center">
                                <button type="button" class="btn btn-outline-danger btn-xs">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                        <hr>
                        <div class="row d-flex h-100">
                            <div class="col-12 text-sm-center col-sm-12 text-md-left col-md-8 justify-content-center align-self-center">
                                <h5 class="product-name"><strong>Sanna</strong></h5>
                            </div>
                            <div class="col-md-2 text-center justify-content-center align-self-center">
                                Saldo:<br><b>€17,26</b>
                            </div>
                            <div class="col-2 col-sm-2 col-md-2 text-right justify-content-center align-self-center">
                                <button type="button" class="btn btn-outline-danger btn-xs">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                        <hr>
                        <div class="row d-flex h-100 alert-danger py-2">
                            <div class="col-12 text-sm-center col-sm-12 text-md-left col-md-8 justify-content-center align-self-center">
                                <h5 class="product-name mb-0"><strong>Pieterson</strong></h5>
                                <b>Mag niet strepen, slado te laag!</b>
                            </div>
                            <div class="col-md-2 text-center justify-content-center align-self-center">
                                Saldo:<br><b>-€5,07</b>
                            </div>
                            <div class="col-2 col-sm-2 col-md-2 text-right justify-content-center align-self-center">
                                <button type="button" class="btn btn-outline-danger btn-xs">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                        <hr>
                        <div class="row d-flex h-100 alert-danger py-2">
                            <div class="col-12 text-sm-center col-sm-12 text-md-left col-md-8 justify-content-center align-self-center">
                                <h5 class="product-name mb-0"><strong>Samantha</strong></h5>
                                <b>Is geen 18, dus geen alcohol!</b>
                            </div>
                            <div class="col-md-2 text-center justify-content-center align-self-center">
                                Saldo:<br><b>€15,67</b>
                            </div>
                            <div class="col-2 col-sm-2 col-md-2 text-right justify-content-center align-self-center">
                                <button type="button" class="btn btn-outline-danger btn-xs">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 pb-3">
                                <h3>Geselecteerde producten:</h3>
                            </div>
                        </div>                        <div class="row">
                            <div class="col-12 text-sm-center col-sm-12 text-md-left col-md-5">
                                <h5 class="product-name"><strong>Hertog Jan</strong></h5>
                            </div>
                            <div class="col-12 col-sm-12 text-sm-center col-md-7 text-md-right row">
                                <div class="col-3 col-sm-3 col-md-5 text-md-right">
                                    <h6><strong>€0.70 <span class="text-muted">x</span></strong></h6>
                                </div>
                                <div class="col-4 col-sm-4 col-md-5">
                                    <div class="quantity">
                                        <input type="button" value="+" class="plus">
                                        <input type="number" step="1" max="99" min="1" value="1" title="Qty" class="qty"
                                               size="4">
                                        <input type="button" value="-" class="minus">
                                    </div>
                                </div>
                                <div class="col-2 col-sm-2 col-md-2 text-right">
                                    <button type="button" class="btn btn-outline-danger btn-xs">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12 text-sm-center col-sm-12 text-md-left col-md-5">
                                <h5 class="product-name"><strong>Snicker</strong></h5>
                            </div>
                            <div class="col-12 col-sm-12 text-sm-center col-md-7 text-md-right row">
                                <div class="col-3 col-sm-3 col-md-5 text-md-right">
                                    <h6><strong>€1.20 <span class="text-muted">x</span></strong></h6>
                                </div>
                                <div class="col-4 col-sm-4 col-md-5">
                                    <div class="quantity">
                                        <input type="button" value="+" class="plus">
                                        <input type="number" step="1" max="99" min="1" value="1" title="Qty" class="qty"
                                               size="4">
                                        <input type="button" value="-" class="minus">
                                    </div>
                                </div>
                                <div class="col-2 col-sm-2 col-md-2 text-right">
                                    <button type="button" class="btn btn-outline-danger btn-xs">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="p-2">
                            <div class="row">
                                Prijs p.p.: <b class="pl-1">€1.90</b>
                            </div>
                            <div class="row">
                                <a href="" class="btn btn-lg btn-success btn-block">Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection