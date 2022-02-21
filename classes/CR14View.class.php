<?php

class CR14View extends Users
{

    public function viewMyCR14($id){
        ?>
        <style xmlns="http://www.w3.org/1999/html">
            @media print {
                .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12 {
                    float: left;
                }
                .col-sm-12 {
                    width: 100%;
                }
                .col-sm-11 {
                    width: 91.66666667%;
                }
                .col-sm-10 {
                    width: 83.33333333%;
                }
                .col-sm-9 {
                    width: 75%;
                }
                .col-sm-8 {
                    width: 66.66666667%;
                }
                .col-sm-7 {
                    width: 58.33333333%;
                }
                .col-sm-6 {
                    width: 50%;
                }
                .col-sm-5 {
                    width: 41.66666667%;
                }
                .col-sm-4 {
                    width: 33.33333333%;
                }
                .col-sm-3 {
                    width: 25%;
                }
                .col-sm-2 {
                    width: 16.66666667%;
                }
                .col-sm-1 {
                    width: 8.33333333%;
                }



            }
        </style>

        <div class="card">
            <div class="card-body">
                <button onclick="goBack()" class="btn btn-outline-secondary">
                    <span class="fa fa-chevron-circle-left"></span>
                </button>
                <h1 class="text-center">CR14 Document</h1>
            </div>
        </div>

        <br>
        <br>
        <div class="row">
            <div class="col-md-1">
            </div>

            <div class="col-md-10">
                <form class="border-top">
                    <div class="card-body card">
                        <div>
                            <button onclick="printDiv('printableArea')" class="btn btn-outline-secondary col-sm-1"><span class="fa fa-print"> Print</span></button>
                        </div>
                        <hr>

                        <div id="printableArea">

                            <div class="text-center">
                                <br>
                                <h1 class="text-secondary font-weight-bold">ZIMBABWE</h1>
                            </div>
                            <br>

                            <div>
                                <span class="float-left">Form CR14</span>
                                <span class="float-right">Section 187 and 330 of Acts</span>
                                <br>
                                <span class="float-right">Section 27 of Regulation</span>
                                <br>
                                <span class="float-left">No. of company ..........</span>
                            </div>
                            <br>
                            <h1 class="text-dark text-center pb-lg-5">THE COMPANIES ACT</h1>

                            <div class="row">
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-6">
                                    <hr class="text-dark font-weight-bold">
                                </div>
                                <div class="col-md-3">
                                </div>
                            </div>
                            <br>

                            <p class="font-weight-bold text-center">Particulars (a) of Register of Directors and Secretaries
                                <br>
                                And of any changes therein
                                <br>
                                OR
                                <br>
                                A list (a) of Directors and Particulars of a Foreign
                                <br>
                                Company
                            </p>
                            <br>

                            <h4 class="text-center text-dark text-decoration-underline"><u>(PRIVATE) LIMITED</u></h4>

                            <br>

                            <span>The registrar of companies</span>
                            <br>
                            <span>HARARE</span>



                            <div class="row">
                                <div class="col-sm-4">
                                </div>
                                <div class="col-sm-4 ">

                                    <div>
                                        <span class="text-center text-dark border p-4"><u>PRESENTED FOR FILLING BY</u></span>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                </div>
                            </div>

                            <br>
                            <br>
                            <br>
                            <br>

                            <!-- LOWER BOTTOM PAGE 2 -->
                            <div>

                                <table class="table-bordered col-sm-12">

                                    <tr>
                                        <th>Date of (a) Appointment</th>
                                        <th>Present Christian Names and Surnames</th>
                                        <th>Nationality</th>
                                        <th>Any Former Names</th>
                                        <th>Full Residential or Business Address and Postal Address</th>
                                        <th>Particulars other Directorship</th>
                                        <th>Nature of change(g)</th>
                                        <th>Date of change(h)</th>
                                        <th>Date Company Notified of change</th>
                                    </tr>

                                    <tr>
                                        <td style="height: 300px"></td>
                                        <td style="height: 300px">Secretaries (d) or Principal Officer (e)</td>
                                        <td style="height: 300px"></td>
                                        <td style="height: 300px"></td>
                                        <td style="height: 300px"></td>
                                        <td style="height: 300px"></td>
                                        <td style="height: 300px"></td>
                                        <td style="height: 300px"></td>
                                        <td style="height: 300px"></td>
                                    </tr>
                                </table>
                                <br>
                                <span> Notes-(a) A complete list of existing directors should always be given. </span>
                                <div>
                                    <ol type="a">
                                        <li>This  date should alwys be shown, whether or not it is in respect of an old or new appointment. </li>
                                        <li>In case of foreign company, if the director is a corporate body, its name and the situation of its principleoffice must  be shown </li>
                                        <li>In the case of the secretary being a corporate body, the name and the situation  of its registered office must be given </li>
                                        <li>In the case of the principal officer being a corporate body or partnership, the corporate or partnership name must be shown, and, if it is a partnership, all the anmes of the partners must be given. </li>
                                        <li>In the case of an individual, if he is a director of any other company registered in Zimbabwe, the name of every such company must be entered.  This applies only in respect of new appointees. </li>
                                        <li>State “Resigned”, “Retired” , “Died” ,  of as the case may be.  In the caseof a new appointment since the last list was filed, it must be stated here in whose place or whether additional. </li>
                                        <li>Give the date of the occurrence referred to in the previous column.  Both columns 8  and 9 must be completed in the event of a change. </li>
                                        <li>This is regarded as the effective date of the entry in the register. </li>
                                    </ol>
                                </div>

                            </div>

                            <br>

                            <div class="row">
                                <div class="col-sm-4"></div>
                                <div class="text-center col-sm-4">
                                    <span class="font-weight-bolder">...................................................................</span>
                                    <br>
                                    Secretary/Director/Principal officer
                                    <br>
                                    <span>Dated <?php echo date("d/m/Y") ?> </span>
                                </div>
                                <div class="col-sm-4"></div>
                            </div>



                            <br>
                            <br>
                            <br>


                            <div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-1">
            </div>
        </div>

        <script>
            function printDiv(divName) {
                var printContents = document.getElementById(divName).innerHTML;
                var originalContents = document.body.innerHTML;

                document.body.innerHTML = printContents;

                window.print();

                document.body.innerHTML = originalContents;
            }
        </script>

        <?php
    }


}