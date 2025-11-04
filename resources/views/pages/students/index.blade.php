@extends('app')
@section('title', 'Student List')
@section('content')
<div class="page-content">
    <div class="row">
        <div class="col-12">
            @include('partials._alert')
            <div class="card radius-10 w-100">
                <div class="card-header d-flex justify-content-between flex-wrap gap-2 pt-3 pb-2 mb-0">
                    <h5 class="mb-0">Gestion Des Elèves</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive mt-4">
                        <table class="table table-striped table-bordered" id="Transaction-History">
                           <thead>
                                <tr class="table-dark">
                                    <th></th>
                                    <th>Student</th>
                                    <th>Date & Time</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>01</th>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="">
                                                <img src="{{ asset('assets/images/avatars/avatar-1.png') }}" class="rounded-circle" width="46" height="46" alt="" />
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="mb-1 font-14">Payment from Michle Jhon</h6>
                                                <p class="mb-0 font-13">Refrence Id #8547846</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Jan 10, 2021</td>
                                    <td>+256.00</td>
                                    <td>
                                        <div class="badge rounded-pill bg-light text-white w-100">Completed</div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>01</th>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="">
                                                <img src="{{ asset('assets/images/avatars/avatar-2.png') }}" class="rounded-circle" width="46" height="46" alt="" />
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="mb-1 font-14">Payment from Pauline Bird</h6>
                                                <p class="mb-0 font-13">Refrence Id #9653248</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Jan 12, 2021</td>
                                    <td>+566.00</td>
                                    <td>
                                        <div class="badge rounded-pill bg-light text-white w-100">In Progress</div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>01</th>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="">
                                                <img src="{{ asset('assets/images/avatars/avatar-3.png') }}" class="rounded-circle" width="46" height="46" alt="" />
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="mb-1 font-14">Payment from Ralph Alva</h6>
                                                <p class="mb-0 font-13">Refrence Id #7689524</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Jan 14, 2021</td>
                                    <td>+636.00</td>
                                    <td>
                                        <div class="badge rounded-pill bg-light text-white w-100">Declined</div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>01</th>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="">
                                                <img src="{{ asset('assets/images/avatars/avatar-4.png') }}" class="rounded-circle" width="46" height="46" alt="" />
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="mb-1 font-14">Payment from John Roman</h6>
                                                <p class="mb-0 font-13">Refrence Id #8335884</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Jan 15, 2021</td>
                                    <td>+246.00</td>
                                    <td>
                                        <div class="badge rounded-pill bg-light text-white w-100">Completed</div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>01</th>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="">
                                                <img src="{{ asset('assets/images/avatars/avatar-7.png') }}" class="rounded-circle" width="46" height="46" alt="" />
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="mb-1 font-14">Payment from David Buckley</h6>
                                                <p class="mb-0 font-13">Refrence Id #7865986</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Jan 16, 2021</td>
                                    <td>+876.00</td>
                                    <td>
                                        <div class="badge rounded-pill bg-light text-white w-100">In Progress</div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>01</th>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="">
                                                <img src="{{ asset('assets/images/avatars/avatar-8.png') }}" class="rounded-circle" width="46" height="46" alt="" />
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="mb-1 font-14">Payment from Lewis Cruz</h6>
                                                <p class="mb-0 font-13">Refrence Id #8576420</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Jan 18, 2021</td>
                                    <td>+536.00</td>
                                    <td>
                                        <div class="badge rounded-pill bg-light text-white w-100">Completed</div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>01</th>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="">
                                                <img src="{{ asset('assets/images/avatars/avatar-9.png') }}" class="rounded-circle" width="46" height="46" alt="" />
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="mb-1 font-14">Payment from James Caviness</h6>
                                                <p class="mb-0 font-13">Refrence Id #3775420</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Jan 18, 2021</td>
                                    <td>+536.00</td>
                                    <td>
                                        <div class="badge rounded-pill bg-light text-white w-100">Completed</div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>01</th>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="">
                                                <img src="{{ asset('assets/images/avatars/avatar-10.png') }}" class="rounded-circle" width="46" height="46" alt="" />
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="mb-1 font-14">Payment from Peter Costanzo</h6>
                                                <p class="mb-0 font-13">Refrence Id #3768920</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Jan 19, 2021</td>
                                    <td>+536.00</td>
                                    <td>
                                        <div class="badge rounded-pill bg-light text-white w-100">Completed</div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>01</th>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="">
                                                <img src="{{ asset('assets/images/avatars/avatar-11.png') }}" class="rounded-circle" width="46" height="46" alt="" />
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="mb-1 font-14">Payment from Johnny Seitz</h6>
                                                <p class="mb-0 font-13">Refrence Id #9673520</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Jan 20, 2021</td>
                                    <td>+86.00</td>
                                    <td>
                                        <div class="badge rounded-pill bg-light text-white w-100">Declined</div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>01</th>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="">
                                                <img src="{{ asset('assets/images/avatars/avatar-12.png') }}" class="rounded-circle" width="46" height="46" alt="" />
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="mb-1 font-14">Payment from Lewis Cruz</h6>
                                                <p class="mb-0 font-13">Refrence Id #8576420</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Jan 18, 2021</td>
                                    <td>+536.00</td>
                                    <td>
                                        <div class="badge rounded-pill bg-light text-white w-100">Completed</div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>01</th>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="">
                                                <img src="{{ asset('assets/images/avatars/avatar-13.png') }}" class="rounded-circle" width="46" height="46" alt="" />
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="mb-1 font-14">Payment from David Buckley</h6>
                                                <p class="mb-0 font-13">Refrence Id #8576420</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Jan 22, 2021</td>
                                    <td>+854.00</td>
                                    <td>
                                        <div class="badge rounded-pill bg-light text-white w-100">In Progress</div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>01</th>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="">
                                                <img src="{{ asset('assets/images/avatars/avatar-14.png') }}" class="rounded-circle" width="46" height="46" alt="" />
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="mb-1 font-14">Payment from Thomas Wheeler</h6>
                                                <p class="mb-0 font-13">Refrence Id #4278620</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Jan 18, 2021</td>
                                    <td>+536.00</td>
                                    <td>
                                        <div class="badge rounded-pill bg-light text-white w-100">Completed</div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {


    });
</script>
@endsection