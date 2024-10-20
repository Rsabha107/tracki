<!-- <script src="{{asset('assets/js/custom.js')}}"></script> -->
<script src="{{ asset ('assets/tracki/js/phoenix.js') }}"></script>
<!-- <script src="{{asset('assets/js/pages/employees.js')}}"></script> -->

<div class="modal-body">
<div class="card bg-white border-0 b-shadow-4 mb-2">
    <div class="card-body pt-2 ">
        <div class="d-flex flex-wrap justify-content-between" id="comment-list">
            <div class="card w-100 rounded-0 border-0 comment">
                <div class="card-horizontal">
                    <div class="card-body border-0 px-1 py-1">
                        <div class="table-responsive text-nowrap">
                            <div class="card-text f-14 text-dark-grey text-justify">
                                <table class="table table-bordered my-3 rounded" id="example">
                                    <thead class="">
                                        <tr>
                                            <th>Leave Type</th>
                                            <th class="text-center">No of Leaves</th>
                                            <th class="text-center">Monthly Limit</th>
                                            <th class="text-center">Total Leaves Taken</th>
                                            <th class="text-center">Remaining Leaves</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><i class="fa fa-circle mr-2 text-success ms-2 me-2" style="color:#16813D"></i>Paid Leave</td>
                                            <td class="text-center">2</td>
                                            <td class="text-center">2</td>
                                            <td class="text-center">{{$totalleavestaken}}</td>
                                            <td class="text-center">{{2-$totalleavestaken}}</td>
                                        </tr>

                                        <!-- <tr>
                                        <td><i class="fa fa-circle mr-2 text-red" style="color:#DB1313"></i>Sick</td>
                                        <td class="text-center">5</td>
                                        <td class="text-center">--</td>
                                        <td class="text-center">0</td>
                                        <td class="text-center">5</td>
                                    </tr>

                                    <tr>
                                        <td><i class="fa fa-circle mr-2 text-red" style="color:#B078C6"></i>Earned</td>
                                        <td class="text-center">5</td>
                                        <td class="text-center">--</td>
                                        <td class="text-center">0</td>
                                        <td class="text-center">5</td>
                                    </tr> -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><?= get_label('close', 'Close') ?></label></button>
</div>
<!-- </form> -->
