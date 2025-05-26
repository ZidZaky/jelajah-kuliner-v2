<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/ts.css">
    <title>Test Case SPRINT 1 JELAJAH KULINER</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.0/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    
    <style>
        /* CSS untuk memastikan setiap card berada dalam satu halaman A4 */
       
    </style>
</head>
<body>
    <div class="container">
        
        <h1>TEST CASE SPRINT 3 - JELAJAH KULINER</h1>
        <h2>PROYEK TINGKAT III X PENGUJIAN PERANGKAT LUNAK</h2>

        <h4>LIST ANGGOTA</h4>
        <ol>
            <li>ZIDAN IRFAN ZAKY                1201220003</li>
            <li>FARHAN NUGRAHA SASONGKO PUTRA   1201220449</li>
            <li>RADINKA PUTRA RAHADIAN          1201220020 </li>
            <li>EVI FITRIYA                     1201222005</li>
            <li>AWAN DHANI WAHONO               1201220443</li>
            <li>RAHMAT EKA SAPUTRA              1201220045</li>
         
        </ol>
    </div>
    @foreach($data as $d)
    <div class="container">
        <!-- Test Case 1 -->
        <table>
            <tr class="header-row">
                <th colspan="2" class="headerdd" >
                    FUNCTIONAL ID: {{{$d['Fitur']}}}
                </th>
            </tr>
            <tr>
                <td><strong>Test Case Description:</strong></td>
                <td>{{{$d['Isi'][0]['TEST_CASE_DESCRIPTION']}}}</td>
            </tr>
            <tr>
                <td><strong>Created By:</strong></td>
                <td>{{{$d['Isi'][0]['CREATED_BY']}}}</td>
            </tr>
            <tr>
                <td><strong>Reviewed By:</strong></td>
                <td>{{{$d['Isi'][0]['EXECUTED_BY']}}}</td>
            </tr>
            <tr>
                <td><strong>Version:</strong></td>
                <td>1</td>
            </tr>
        </table>
        @foreach($d['Isi'] as $dd)
            <div class="test-info" style="background-color: #130a32 !important;color: white !important;">
                <strong>Test Scenario Type:</strong> {{{$dd['TYPE']}}}
            </div>
            <div class="qa-log" style="background-color: #130a32 !important;color: white !important;">
                <strong>QA Tester's Log:</strong>
            </div>


            <div class="test-info" style="background-color: #130a32 !important;color: white !important;">
                <strong>Tester Name:</strong> {{{$dd['CREATED_BY']}}} <br>
                <strong>Date Tested:</strong> {{{$dd['DATE_OF_CREATION']}}}
            </div>

            <div class="tablepisah">
                <div>
                    <table style="font-size: 10px;">
                        <tr>
                            <td><strong>No.</strong></td>
                            <td><strong>Prerequisites</strong></td>
                        </tr>
                        @for($i=0;$i<count($dd['PREREQUISITIES']);$i++)
                        <tr>
                            <td>{{{$i+1}}}</td>
                            <td>{{{$dd['PREREQUISITIES'][$i]}}}</td>
                        </tr>
                        @endfor
                    </table>
                </div>
                <div>
                    <table style="font-size: 10px;">
                        <tr>
                            <td><strong>No.</strong></td>
                            <td><strong>Test Data</strong></td>
                        </tr>
                        @for($i=0;$i<count($d['TEST_DATA']);$i++)
                        <tr>
                            <td>{{{$i+1}}}</td>
                            <td>{{{$d['TEST_DATA'][$i]}}}</td>
                        </tr>
                        @endfor
                    </table>
                </div>
            </div>

            

            <table style="font-size: 10px;">
                <tr>
                    <th>Step Number</th>
                    <th>Step Details</th>
                    <th>Expected Results</th>
                    <th>Actual Results</th>
                    <th>Pass/Fail/Not Executed/Suspended</th>
                </tr>
                @for($i=0;$i<count($d['TEST_STEPS']);$i++)
                <tr>
                    <td>{{{$i+1}}}</td>
                    <td>{{{$d['TEST_STEPS'][$i]}}}</td>
                    <td>{{{$d['EXPECTED_RESULT']}}}</td>
                    @if($i!=(count($d['TEST_STEPS'])-1))
                    <td>As Expected</td>
                    @else
                    <td>{{{$d['ACTUAL_RESULT']}}}</td>
                    @endif
                    <td class="pass">{{{$d['STATUS']}}}</td>
                </tr>
                @endfor
            </table>
        @endforeach

    </div>
    @endforeach

    <!-- Tombol untuk download PDF -->
    <script>
      function downloadPDF() {
        const content = document.querySelector(".container");

        if (content) {
          // Tunggu beberapa detik sebelum merender PDF
          setTimeout(() => {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();

            // Menambahkan konten HTML ke dalam PDF
            doc.html(content, {
              callback: function (doc) {
                doc.save('test_case.pdf');  // Nama file PDF yang akan diunduh
              },
              x: 10,
              y: 10
            });
          }, 1000); // Menunggu 1 detik untuk memastikan semua elemen dimuat
        } else {
          console.error("Elemen container tidak ditemukan!");
        }
      }
    </script>

</body>
</html>
