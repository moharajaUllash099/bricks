<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>Print Table</title>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    {{--jquery--}}
    <script type="text/javascript" src="{{ asset('soft/jquery/jquery-3.3.1.min.js') }}"></script>
    <style>
        body {
            font: 12pt Georgia, "Times New Roman", Times, serif;
            line-height: 1.3;
        }
        /*
        print
         */
        @page {
            size: landscape; /*portrait*/
            /* set page margins */
            margin: 0.5cm 0.5cm;
            /* Default footers */
            @bottom-left {
                content: "powered by Rowshan Soft";
            }
            @bottom-right {
                content: counter(page) " of " counter(pages);
            }
        }
        /*
        ID css
         */
        .id-card {
            background-color: #fff;
            padding: 10px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 0 1.5px 0px #b9b9b9;
            margin: 10px;
            border: 1px solid black;
        }
        .id-card img {
            margin: 0 auto;
        }
        .header img {
            width: 100px;
            margin-top: 15px;
        }
        .photo img {
            width: 90px;
            height: 100px;
            margin-top: 15px;
        }
        h2 {
            font-size: 18px;
            margin: 10px 0;
        }
        h3 {
            font-size: 12px;
            margin: 2.5px 0;
            font-weight: 300;
        }
        .qr-code img {
            width: 50px;
        }
        p {
            font-size: 12px;
            margin: 2px;
        }
        /*
        custom css for id
         */
        .header h2{
            font-size: 20px;
        }
        hr{
            margin: 10px;
        }
    </style>
</head>
<body cz-shortcut-listen="true">
<table style="width: 100%">
    <tr>
        <td style="width: 25%"></td>
        <td style="width: 25%">
            @if(isset($this_info[0]))
                <div class="id-card">
                    <div class="header">
                        <h2>{{ucwords(get_basic_setting('company'))}}</h2>
                    </div>
                    <div class="photo">
                        <?php $img = asset('soft/uploads'); ?>
                        @if(!empty($this_info[0]->img))
                            <img class="img-rounded" src="{{$img.'/'.$this_info[0]->img}}">
                        @else
                            <img src="{{$img.'/'.'default/user.png'}}">
                        @endif
                    </div>
                    <h2>{{$this_info[0]->name}}</h2>
                    <h3>{{$this_info[0]->personal_mobile}}</h3>
                    <div class="qr-code">
                        <?php
                        // Personal Information
                        $firstName = $this_info[0]->name;
                        $lastName = '';
                        $title = '';
                        $email = (!empty($this_info[0]->email)) ? $this_info[0]->email : '';

                        // Addresses
                        $homeAddress = [
                            'type' => 'home',
                            'pref' => true,
                            'street' => (!empty($this_info[0]->house_address)) ? $this_info[0]->house_address : '',
                            'city' => (!empty($this_info[0]->city) and !empty($this_info[0]->area)) ? $this_info[0]->city.', '.$this_info[0]->area : '',
                            'state' => '',
                            'country' => (!empty($this_info[0]->country)) ? get_country($this_info[0]->country) : '',
                            'zip' => (!empty($this_info[0]->country)) ? $this_info[0]->post_code : ''
                        ];
                        $wordAddress = [
                            'type' => 'work',
                            'pref' => false,
                            'street' => '',
                            'city' => '',
                            'state' => '',
                            'country' => '',
                            'zip' => ''
                        ];

                        $addresses = [$homeAddress, $wordAddress];

                        // Phones
                        $workPhone = [
                            'type' => 'mobile',
                            'number' => (!empty($this_info[0]->personal_mobile)) ? $this_info[0]->personal_mobile : '',
                            'cellPhone' => false
                        ];
                        $homePhone = [
                            'type' => 'home',
                            'number' => (!empty($this_info[0]->alt_mobile)) ? $this_info[0]->alt_mobile : '',
                            'cellPhone' => false
                        ];

                        $phones = [$workPhone, $homePhone];

                        echo QRCode::vCard($firstName, $lastName, $title, $email, $addresses, $phones)
                            ->setErrorCorrectionLevel('H')
                            ->setSize(1)
                            ->setMargin(2)
                            ->svg();
                        ?>
                    </div>
                    <hr>
                    {!! get_basic_setting('address') !!}
                    <p style="font-size: 10px"> <i class="fa fa-phone" aria-hidden="true"></i> : {{get_basic_setting('phone')}} | <i class="fa fa-envelope" aria-hidden="true"></i> : {{get_basic_setting('email')}}</p>
                </div>
            @endif
        </td>
        <td style="width: 25%"></td>
        <td style="width: 25%"></td>
    </tr>
</table>
<div id="footer">
    <small>Powered by: Rowshan Soft. www.rowshansoft.com | 01533105564</small>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        window.print();
    });
    window.onafterprint = function() {
        history.go(-1);
    };

    /*good*/
</script>
</body>
</html>