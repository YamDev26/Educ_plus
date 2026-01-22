@extends('app')
@section('title', 'Resultat')
@section('content')
<div class="page-content">
  <div class="card">
    <div class="card-body">
      <div id="invoice">
        <div class="toolbar hidden-print">
          <div class="text-end">
            <button type="button" class="btn btn-dark" onclick="window.print()"><i class="fa fa-print"></i> Print</button>
            <button type="button" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Export as PDF</button>
          </div>
          <hr>
        </div>
        <div class="invoice overflow-auto">
          <div style="min-width: 600px px-2">
            {{-- <header>
              <div class="row">
                <div class="col">
                  <a href="javascript:;">
                    <img src="assets/images/logo-icon.png" width="80" alt="">
                  </a>
                </div>
                <div class="col company-details">
                  <h2 class="name">
                    <a target="_blank" href="javascript:;">
                    Arboshiki
                    </a>
                  </h2>
                  <div>455 Foggy Heights, AZ 85004, US</div>
                  <div>(123) 456-789</div>
                  <div>company@example.com</div>
                </div>
              </div>
            </header> --}}
            <main>
              <div class="row contacts px-2">
                <div class="col invoice-to">
                  <h3 class="to">6eme1</h3>
                  <div class="address">PP : M. KOFFI Jean-Luc</div>
                </div>
                <div class="col invoice-details">
                  <h3 class="to">Trimestre 1</h3>
                  <div class="date">Effectif : 38</div>
                </div>
              </div>
              <table>
                <thead>
                  <tr>
                    <th>#</th>
                    <th class="text-left">DESCRIPTION</th>
                    <th class="text-right">Moy Sup ou Egal à 10</th>
                    <th class="text-right">Moy Inf à 10</th>
                    <th class="text-right">Moyenne</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="no">04</td>
                    <td class="text-left">
                      <h3>
              <a target="_blank" href="javascript:;">
              Youtube channel
              </a>
              </h3>
                      <a target="_blank" href="javascript:;">
                  Useful videos
                </a> to improve your Javascript skills. Subscribe and stay tuned :)</td>
                    <td class="unit">$0.00</td>
                    <td class="qty">100</td>
                    <td class="total">$0.00</td>
                  </tr>
                  <tr>
                    <td class="no">01</td>
                    <td class="text-left">
                      <h3>Website Design</h3>Creating a recognizable design solution based on the company's existing visual identity</td>
                    <td class="unit">$40.00</td>
                    <td class="qty">30</td>
                    <td class="total">$1,200.00</td>
                  </tr>
                  <tr>
                    <td class="no">02</td>
                    <td class="text-left">
                      <h3>Website Development</h3>Developing a Content Management System-based Website</td>
                    <td class="unit">$40.00</td>
                    <td class="qty">80</td>
                    <td class="total">$3,200.00</td>
                  </tr>
                  <tr>
                    <td class="no">03</td>
                    <td class="text-left">
                      <h3>Search Engines Optimization</h3>Optimize the site for search engines (SEO)</td>
                    <td class="unit">$40.00</td>
                    <td class="qty">20</td>
                    <td class="total">$800.00</td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="2"></td>
                    <td colspan="2">SUBTOTAL</td>
                    <td>$5,200.00</td>
                  </tr>
                  <tr>
                    <td colspan="2"></td>
                    <td colspan="2">TAX 25%</td>
                    <td>$1,300.00</td>
                  </tr>
                  <tr>
                    <td colspan="2"></td>
                    <td colspan="2">GRAND TOTAL</td>
                    <td>$6,500.00</td>
                  </tr>
                </tfoot>
              </table>
              <div class="thanks">Thank you!</div>
              <div class="notices">
                <div>NOTICE:</div>
                <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
              </div>
            </main>
            <footer>Invoice was created on a computer and is valid without the signature and seal.</footer>
          </div>
          <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
          <div></div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection