@extends('layouts.master')
@section('content')

     <!-- Start Page title and tab -->
     <div class="section-body">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center ">
                <div class="header-action">
                    <h1 class="page-title">School</h1>
                    <ol class="breadcrumb page-breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Student</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Student</li>
                    </ol>
                </div>
                <ul class="nav nav-tabs page-header-tab">
                    @can('student-list')
                        <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#student">List View</a></li>
                    @endcan

                    @can('add-subject')
                    <li class="nav-item"><a class="nav-link" id="Library-tab-Boot" data-toggle="tab" href="#student-add"> </a></li>
                    @endcan
                    @can('subject-class-list')
                        <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#classsubject"></a></li>
                    @endcan

                    @can('add-student')
                    <li class="nav-item"><a class="nav-link" id="Library-tab-Boot" data-toggle="tab" href="#student-add">Add Student </a></li>
                    @endcan
                    @can('subject-class-list')
                        <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#classsubject"></a></li>
                    @endcan

                    @can('assign-subject-class')
                    <li class="nav-item"><a class="nav-link" id="Library-tab-Boot" data-toggle="tab" href="#student-add"> </a></li>
                    @endcan
                </ul>
            </div>
        </div>
        @if (\Session::has('status'))
           <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert"></button>
                <p>{{ \Session::get('status') }}</p>
            </div>
        @endif
        @if (\Session::has('success'))
           <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert"></button>
                <p>{{ \Session::get('success') }}</p>
            </div>
        @endif
        @if (\Session::has('danger'))
        <div class="alert alert-danger alert-dismissible">
         <button type="button" class="close" data-dismiss="alert"></button>
             <p>{{ \Session::get('danger') }}</p>
         </div>
     @endif

     @if (count($errors) > 0)
     <div class="alert alert-success alert-dismissible">
        <a class="btn btn-primary" href="{{ route('student.index') }}"> Back to Students</a>
         <button type="button" class="close" data-dismiss="alert"></button>
         <strong>Opps!</strong> Something went wrong, please check where you  add data .<br><br>
         <ul>
             @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
             @endforeach
         </ul>
     </div>
 @endif
    </div>
    <div class="section-body mt-4">
        <div class="container-fluid">
            <div class="tab-content">



                <div class="tab-pane active" id="student">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-striped table_custom">
                                    <thead>

                                            <tr>
                                                <th>SN</th>
                                                <th>Admin NO.</th>
                                                <th>Name</th>
                                                 <th> </th>
                                                 <th>House </th>
                                                <th>Age</th>
                                                <th>Gender</th>

                                                <th>Action</th>
                                                <th>More</th>
                                            </tr>

                                    </thead>
                                    <tbody>
                                        <?php $sn = 1; ?>
                                     @foreach ($student as $sc)
                                     <tr id="sid{{ $sc->id }}">
                                         <td>{{ $sn++ }}</td>
                                         <td>{{ $sc->admissionNo }} </td>
                                         <td>{{ $sc->firstname }} {{ $sc->lastname }}</td>
                                          <?php

                                         if ($sc->picture == NULL || $sc->picture =="" || !isset($sc->picture) ){

                                               // $cimage =  $imageclass;
                                                $image =  'unnamed.png';
                                         }else {

                                            $image =  $sc->picture;
                                         }

                                         ?>
                                         <td><img  class = "avatar avatar-lg" src="{{ asset('images/studentpics/'.$image) }}"/></td>
                                         <td>{{ $sc->house }}</td>
                                         <td>{{ $sc->dateofbirth }}</td>
                                         <td>{{ $sc->gender }}</td>

                                         <td>
                                             <div class="btn-group">
                                                 @can('student-edit')
                                                 <a href="{{ route('student.edit',$sc->id) }}" class="btn fa fa-pencil" data-toggle="tooltip" title="Edit Student Data"></a>
                                                 @endcan
                                                 </div>
                                             <div class="btn-group">
                                             @can('student-delete')
                                             <a href="javascript:void(0)" class="btn fa fa-trash delete"
                                                 data-toggle="tooltip" title="Delete Student Data" onClick="check({{ $sc->id }})"></a>
                                               @endcan
                                         </div>
                                     </td>
                                     <td>
                                        <div class="dropdown">
                                        <button type="button" class="btn btn-primary  bt-xs dropdown-toggle" data-toggle="dropdown">
                                            <i class="fe fe-plus mr-2"></i>More
                                        </button>
                                        <div class="dropdown-menu">
                                            @can('parent-edit')
                                                <a class="dropdown-item" href="{{ route('parent.edit',$sc->id) }}">Parent Bio Data</a>
                                            @endcan
                                            @can('student-picture-upload')
                                                <a class="dropdown-item" href="{{ route('studentImageUpload.edit',$sc->id) }}">Student Picture</a>
                                            @endcan
                                            @can('add-studenthouse')
                                            <a class="dropdown-item" href="{{ route('studenthouse.edit',$sc->id) }}">Student House</a>
                                            @endcan

                                        </div>
                                    </div>
                                     </td>
                                    </tr>

                                     @endforeach
                                     </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="tab-pane" id="student-add">
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Create Student BioData Info</h3>
                                    <div class="card-options ">
                                        <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                        <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                                    </div>
                                </div>


                                <div class="card">
                                    <div class="card-body">




                                 <form  role="form" id="inline-validation" class="form-horizontal form-stripe" action="{{ route('student.store') }}" onSubmit="age();" method="POST">
                                            @csrf


                                        <script type="text/javascript">

                                            var nigeria = new Array(
                                                "Abia State",
                                                "Adamawa State",
                                                "Akwa Ibom State",
                                                "Anambra State",
                                                "Bauchi State",
                                                "Bayelsa State",
                                                "Benue State",
                                                "Borno State",
                                                "Cross River State",
                                                "Delta State",
                                                "Ebonyi State",
                                                "Edo State",
                                                "Ekiti",
                                                "Enugu State",
                                                "FCT",
                                                "Gombe State",
                                                "Imo State",
                                                "Jigawa State",
                                                "Kaduna State",
                                                "Kano State",
                                                "Katsina State",
                                                "Kebbi State",
                                                "Kogi State",
                                                "Kwara State",
                                                "Lagos State",
                                                "Nasarawa State",
                                                "Niger State",
                                                "Ogun State",
                                                "Ondo State",
                                                "Osun State",
                                                "Oyo State",
                                                "Plateau State",
                                                "Rivers State",
                                                "Sokoto State",
                                                "Taraba State",
                                                "Yobe State",
                                                "Zamfara State");



                                            var s_a = new Array();

                                            s_a[0] = "";
                                            s_a[1] = "Aba South|Arochukwu|Bende|Ikwuano|Isiala Ngwa North|Isiala Ngwa South|Isuikwuato|Obi Ngwa|Ohafia|Osisioma|Ugwunagbo|Ukwa East|Ukwa West|Umuahia North|Umuahia South|Umu Nneochi";
                                            s_a[2] = "Fufure|Ganye|Gayuk|Gombi|Grie|Hong|Jada|Lamurde|Madagali|Maiha|Mayo Belwa|Michika|Mubi North|Mubi South|Numan|Shelleng|Song|Toungo|Yola North|Yola South";
                                            s_a[3] = "Eastern Obolo|Eket|Esit Eket|Essien Udim|Etim Ekpo|Etinan|Ibeno|Ibesikpo Asutan|Ibiono-Ibom|Ika|Ikono|Ikot Abasi|Ikot Ekpene|Ini|Itu|Mbo|Mkpat-Enin|Nsit-Atai|Nsit-Ibom|Nsit-Ubium|Obot Akara|Okobo|Onna|Oron|Oruk Anam|Udung-Uko|Ukanafun|Uruan|Urue-Offong Oruko|Uyo";
                                            s_a[4] = "Anambra East|Anambra West|Anaocha|Awka North|Awka South|Ayamelum|Dunukofia|Ekwusigo|Idemili North|Idemili South|Ihiala|Njikoka|Nnewi North|Nnewi South|Ogbaru|Onitsha North|Onitsha South|Orumba North|Orumba South|Oyi";
                                            s_a[5] = "Bauchi|Bogoro|Damban|Darazo|Dass|Gamawa|Ganjuwa|Giade|Itas\/Gadau|Jama are|Katagum|Kirfi|Misau|Ningi|Shira|Tafawa Balewa|Toro|Warji|Zaki";
                                            s_a[6] = "Ekeremor|Kolokuma\/Opokuma|Nembe|Ogbia|Sagbama|Southern Ijaw|Yenagoa";
                                            s_a[7] = "Apa|Ado|Buruku|Gboko|Guma|Gwer East|Gwer West|Katsina-Ala|Konshisha|Kwande|Logo|Makurdi|Obi|Ogbadibo|Ohimini|Oju|Okpokwu|Oturkpo|Tarka|Ukum|Ushongo|Vandeikya";
                                            s_a[8] = "Askira\/Uba|Bama|Bayo|Biu|Chibok|Damboa|Dikwa|Gubio|Guzamala|Gwoza|Hawul|Jere|Kaga|Kala\/Balge|Konduga|Kukawa|Kwaya Kusar|Mafa|Magumeri|Maiduguri|Marte|Mobbar|Monguno|Ngala|Nganzai|Shani";
                                            s_a[9] = "Cross River State|Akamkpa|Akpabuyo|Bakassi|Bekwarra|Biase|Boki|Calabar Municipal|Calabar South|Etung|Ikom|Obanliku|Obubra|Obudu|Odukpani|Ogoja|Yakuur|Yala";
                                            s_a[10] = "Aniocha Souths|Bomadi|Burutu|Ethiope East|Ethiope West|Ika North East|Ika South|Isoko North|Isoko South|Ndokwa East|Ndokwa West|Okpe|Oshimili North|Oshimili South|Patani|Sapele|Udu|Ughelli North|Ughelli South|Ukwuani|Uvwie|Warri North|Warri South|Warri South West";
                                            s_a[11] = "Afikpo North|Afikpo South|Ebonyi|Ezza North|Ezza South|Ikwo|Ishielu|Ivo|Izzi|Ohaozara|Ohaukwu|Onicha";
                                            s_a[12]= "Egor|Esan Central|Esan North-East|Esan South-East|Esan West|Etsako Central|Etsako East|Etsako West|Igueben|Ikpoba Okha|Orhionmwon|Oredo|Ovia North-East|Ovia South-West|Owan East|Owan West|Uhunmwonde";
                                            s_a[13]= "Efon|Ekiti East|Ekiti South-West|Ekiti West|Emure|Gbonyin|Ido Osi|Ijero|Ikere|Ikole|Ilejemeje|Irepodun\/Ifelodun|Ise\/Orun|Moba|Oye";
                                            s_a[14]="Awgu|Enugu East|Enugu North|Enugu South|Ezeagu|Igbo Etiti|Igbo Eze North|Igbo Eze South|Isi Uzo|Nkanu East|Nkanu West|Nsukka|Oji River|Udenu|Udi|Uzo Uwani";
                                            s_a[15]= "Bwari|Gwagwalada|Kuje|Kwali|Municipal Area Council";
                                            s_a[16]= "Balanga|Billiri|Dukku|Funakaye|Gombe|Kaltungo|Kwami|Nafada|Shongom|Yamaltu\/Deba";
                                            s_a[17]= "Ahiazu Mbaise|Ehime Mbano|Ezinihitte|Ideato North|Ideato South|Ihitte\/Uboma|Ikeduru|Isiala Mbano|Isu|Mbaitoli|Ngor Okpala|Njaba|Nkwerre|Nwangele|Obowo|Oguta|Ohaji\/Egbema|Okigwe|Orlu|Orsu|Oru East|Oru West|Owerri Municipal|Owerri North|Owerri West|Unuimo";
                                            s_a[18]= "Babura|Biriniwa|Birnin Kudu|Buji|Dutse|Gagarawa|Garki|Gumel|Guri|Gwaram|Gwiwa|Hadejia|Jahun|Kafin Hausa|Kazaure|Kiri Kasama|Kiyawa|Kaugama|Maigatari|Malam Madori|Miga|Ringim|Roni|Sule Tankarkar|Taura|Yankwashi";
                                            s_a[19]= "Chikun|Giwa|Igabi|Ikara|Jaba|Jema'a|Kachia|Kaduna North|Kaduna South|Kagarko|Kajuru|Kaura|Kauru|Kubau|Kudan|Lere|Makarfi|Sabon Gari|Sanga|Soba|angon Kataf|Zaria";
                                            s_a[20]= "Albasu|Bagwai|Bebeji|Bichi|Bunkure|Dala|Dambatta|Dawakin Kudu|Dawakin Tofa|Doguwa|Fagge|Gabasawa|Garko|Garun Mallam|Gaya|Gezawa|Gwale|Gwarzo|Kabo|Kano Municipal|Karaye|Kibiya|Kiru|Kumbotso|Kunchi|Kura|Madobi|Makoda|Minjibir|Nasarawa|Rano|Rimin Gado|Rogo|Shanono|Sumaila|Takai|Tarauni|Tofa|Tsanyawa|Tudun Wada|Ungogo|Warawa|Wudil";
                                            s_a[21]= "Batagarawa|Batsari|Baure|Bindawa|Charanchi|Dandume|Danja|Dan Musa|Daura|Dutsi|Dutsin Ma|Faskari|Funtua|Ingawa|Jibia|Kafur|Kaita|Kankara|Kankia|Katsina|Kurfi|Kusada|Mai'Adua|Malumfashi|Mani|Mashi|Musawa|Rimi|Sabuwa|Safana|Sandamu|Zango";
                                            s_a[22]= "Arewa Dandi|Argungu|Augie|Bagudo|Birnin Kebbi|Bunza|Dandi|Fakai|Gwandu|Jega|Kalgo|Koko\/Besse|Maiyama|Sakaba|Shanga|Suru|Wasagu\/Danko|Yauri|Zuru";
                                            s_a[23]= "Ajaokuta|Ankpa|Bassa|Dekina|Ibaji|Idah|Igalamela Odolu|Ijumu|Kabba\/Bunu|Kogi|Lokoja|Mopa Muro|Ofu|Ogori\/Magongo|Okehi|Okene|Olamaboro|Omala|Yagba East|Yagba West";
                                            s_a[24]= "Baruten|Edu|Ekiti|Ifelodun|Ilorin East|Ilorin South|Ilorin West|Irepodun|Isin|Kaiama|Moro|Offa|Oke Ero|Oyun|Pategi";
                                            s_a[25]= "Ajeromi-Ifelodun|Alimosho|Amuwo-Odofin|Apapa|Badagry|Epe|Eti Osa|Ibeju-Lekki|Ifako-Ijaiye|Ikeja|Ikorodu|Kosofe|Lagos Island|Lagos Mainland|Mushin|Ojo|Oshodi-Isolo|Shomolu|Surulere";
                                            s_a[26]= "Awe|Doma|Karu|Keana|Keffi|Kokona|Lafia|Nasarawa|Nasarawa Egon|Obi|Toto|Wamba";
                                            s_a[27]= "Agwara|Bida|Borgu|Bosso|Chanchaga|Edati|Gbako|Gurara|Katcha|Kontagora|Lapai|Lavun|Magama|Mariga|Mashegu|Mokwa|Moya|Paikoro|Rafi|Rijau|Shiroro|Suleja|Tafa|Wushishi";
                                            s_a[28]= "Abeokuta South|Ado-Odo\/Ota|Egbado North|Egbado South|Ewekoro|Ifo|Ijebu East|Ijebu North|Ijebu North East|Ijebu Ode|kenne|Imeko Afon|Ipokia|Obafemi Owode|Odeda|Odogbolu|Ogun Waterside|Remo North|Shagamu";
                                            s_a[29]= "Akoko North-West|Akoko South-West|Akoko South-East|Akure North|Akure South|Ese Odo|Idanre|Ifedore|Ilaje|Ile Oluji\/Okeigbo|Irele|Odigbo|Okitipupa|Ondo East|Ondo West|Ose|Owo";
                                            s_a[30]= "Atakunmosa West|Aiyedaade|Aiyedire|Boluwaduro|Boripe|Ede North|Ede South|Ife Central|Ife East|Ife North|Ife South|Egbedore|Ejigbo|Ifedayo|Ifelodun|Ila|Ilesa East|Ilesa West|Irepodun|Irewole|Isokan|Iwo|Obokun|Odo Otin|Ola Oluwa|Olorunda|Oriade|Orolu|Osogbo";
                                            s_a[31]= "Akinyele|Atiba|Atisbo|Egbeda|Ibadan North|Ibadan North-East|Ibadan North-West|Ibadan South-East|Ibadan South-West|Ibarapa Central|Ibarapa East|Ibarapa North|Ido|Irepo|Iseyin|Itesiwaju|Iwajowa|Kajola|Lagelu|Ogbomosho North|Ogbomosho South|Ogo Oluwa|Olorunsogo|Oluyole|Ona Ara|Orelope|Ori Ire|Oyo|Oyo East|Saki East|Saki West|Surulere";
                                            s_a[32]= "Barkin Ladi|Bassa|Jos East|os North|Jos South|Kanam|Kanke|Langtang South|Langtang North|Mangu|Mikang|Pankshin|Qua'an Pan|Riyom|Shendam|Wase";
                                            s_a[33]= "Ahoada East|Ahoada West|Akuku-Toru|Andoni|Asari-Toru|Bonny|Degema|Eleme|Emuoha|Etche|Gokana|Ikwerre|Khana|Obio\/Akpor|Ogba\/Egbema\/Ndoni|Ogu\/Bolo|Okrika|Omuma|Opobo\/Nkoro|Oyigbo|Port Harcourt|Tai";
                                            s_a[34]= "Bodinga|Dange Shuni|Gada|Goronyo|Gudu|Gwadabawa|Illela|Isa|Kebbe|Kware|Rabah|Sabon Birni|Shagari|Silame|Sokoto North|Sokoto South|Tambuwal|Tangaza|Tureta|Wamako|Wurno|Yabo";
                                            s_a[35]= "Bali|Donga|Gashaka|Gassol|Ibi|Jalingo|Karim Lamido|Kumi|Lau|Sardauna|Takum|Ussa|Wukari|Yorro|Zing";
                                            s_a[36]= "Bursari|Damaturu|Fika|Fune|Geidam|Gujba|Gulani|Jakusko|Karasuwa|Machina|Nangere|Nguru|Potiskum|Tarmuwa|Yunusari|Yusufari";
                                            s_a[37]= "Bakura|Birnin Magaji\/Kiyaw|Bukkuyum|Bungudu|Gummi|Gusau|Kaura Namoda|Maradun|Maru|Shinkafi|Talata Mafara|Chafe|Zurmi";

                                            function populateStates(countryElementId, stateElementId) {

                                                var selectedCountryIndex = document.getElementById(countryElementId).selectedIndex;

                                                var stateElement = document.getElementById(stateElementId);

                                                stateElement.length = 0; // Fixed by Julian Woods
                                                stateElement.options[0] = new Option('Select Local Government', '');
                                                stateElement.selectedIndex = 0;

                                                var state_arr = s_a[selectedCountryIndex].split("|");

                                                for (var i = 0; i < state_arr.length; i++) {
                                                    stateElement.options[stateElement.length] = new Option(state_arr[i], state_arr[i]);
                                                }
                                            }

                                            function populateCountries(countryElementId, stateElementId) {
                                                // given the id of the <select> tag as function argument, it inserts <option> tags
                                                var countryElement = document.getElementById(countryElementId);
                                                countryElement.length = 0;
                                                countryElement.options[0] = new Option('Select State', '-1');
                                                countryElement.selectedIndex = 0;
                                                for (var i = 0; i < nigeria.length; i++) {
                                                    countryElement.options[countryElement.length] = new Option(nigeria[i], nigeria[i]);
                                                }

                                                // Assigned all countries. Now assign event listener for the states.

                                                if (stateElementId) {
                                                    countryElement.onchange = function () {
                                                        populateStates(countryElementId, stateElementId);
                                                    };
                                                }
                                            }
                                        </script>





                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Admission No. <span class="text-danger">*</span></label>
                                            <div class="col-md-7">
                                                <input type="text" class="form-control"  name="admissionNo" id="name"  placeholder="Name" required>
                                            </div>
                                        </div>




                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Title <span class="text-danger">*</span></label>
                                            <div class="col-md-7">


                                                    <select  class="form-control" name="title" id="title" required>
                                                        <option value="">Select Title </option>
                                                        <option value="Mr">Mr</option>
                                                        <option value="Mrs">Mrs</option>
                                                        <option value="Miss">Miss</option>
                                                    </select>


                                            </div>
                                        </div>



                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">First Name <span class="text-danger">*</span></label>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control"  name="firstname" id="name"  placeholder="First Name" required>
                                                </div>
                                            </div>



                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Last Name <span class="text-danger">*</span></label>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control"  name="lastname" id="name"  placeholder="LAst Name" required>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Other Name <span class="text-danger">*</span></label>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control"  name="othername" id="name"  placeholder="Other Name" required>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Gender <span class="text-danger">*</span></label>
                                                <div class="col-md-7">

                                                    <select  class="form-control" name="gender" id="gender" required>

                                                       <option value="">Select Gender </option>
                                                       <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>

                                                </div>
                                            </div>



                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Home Address <span class="text-danger">*</span></label>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control"  name="home_address" id="employmentid"  placeholder="Home Address" required>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Home Address 2<span class="text-danger">*</span></label>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control"  name="home_address2" id="employmentid"  placeholder="Home Address2" required>
                                                </div>
                                            </div>



                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Date of birth <span class="text-danger">*</span></label>
                                                <div class="col-md-7">
                                                    <input type="date" class="form-control"  name="dateofbirth" id="dateofbirth" onkeyup="showage()"  placeholder="Date of Birth" required>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Age <span class="text-danger">*</span></label>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control"  name="age1" id="age1"  onkeyup="showage()" placeholder="Age" readonly>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Place of birth <span class="text-danger">*</span></label>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control"  name="placeofbirth" id="placeofbirth"  placeholder="Plate of Birth" required>
                                                </div>
                                            </div>





                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Nationality <span class="text-danger">*</span></label>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control" name="nationality" id="nationality"  placeholder="nationality" required>
                                                </div>
                                            </div>




                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Select State of Origin<span class="text-danger">*</span></label>
                                                <div class="col-md-7">
                                                    <select  class="form-control" id="state" data-rel="chosen" name="state" required>


                                                    <option value="" selected>Select State </option>


                                                    </select>
                                                </div>
                                            </div>



                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Select Local Goverment<span class="text-danger">*</span></label>
                                                <div class="col-md-7">
                                                    <select  class="form-control" id="local" data-rel="chosen" name="local" required >

                                                        <option value="" selected>Select Local </option>

                                                    </select>
                                                </div>
                                            </div>

                                            <script language="javascript">
                                                populateCountries("state", "local");
                                            </script>


                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Select Region <span class="text-danger">*</span></label>
                                                <div class="col-md-7">
                                                    <select  class="form-control" id="religion" data-rel="chosen" name="religion" required>

                                                        <option value="" selected>Select Religion </option>
                                                       <option value="Christianity">Christianity</option>
                                                        <option value="Islam">Islam</option>
                                                        <option value="others">Others</option>
                                                    </select>
                                                </div>
                                            </div>





                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Last School Attended<span class="text-danger">*</span></label>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control" name="last_school" id="nationality"  placeholder="Last School" required >
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Last Class <span class="text-danger">*</span></label>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control" name="last_class" id="nationality"  placeholder="Last Class " required>
                                                </div>
                                            </div>


                                    </div>








                                        </div>
                            </div>


                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Create Student Class Info</h3>
                                    <div class="card-options ">
                                        <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                        <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                                    </div>
                                </div>


                                <div class="card">
                                    <div class="card-body">


                                       <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Select Class <span class="text-danger">*</span></label>
                                                <div class="col-md-7">
                                                    <select name ="schoolclassid" id="schoolclassid"  class="form-control" required>
                                                        <option value="" selected>Select Class</option>
                                                           @foreach ($schoolclass as $class => $name )
                                                         <option value="{{$name->id}}">{{ $name->schoolclass }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ $name->arm}} </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Select Term <span class="text-danger">*</span></label>
                                                <div class="col-md-7">
                                                    <select name ="termid" id="termid"  class="form-control" required>
                                                        <option value="" selected>Select Term </option>
                                                        @foreach ($schoolterm as $term => $name )
                                                         <option value="{{$name->id}}">{{ $name->term}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Select Current Session <span class="text-danger">*</span></label>
                                                <div class="col-md-7">
                                                    <select name ="sessionid" id="sessiionid"  class="form-control" required>
                                                        <option value="" selected>Select Session </option>
                                                        @foreach ($schoolsession as $schoolsession => $name )
                                                         <option value="{{$name->id}}">{{ $name->session}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label"></label>
                                                <div class="col-md-7">
                                                    <button type="submit" class="btn btn-primary">Submit Data</button>

                                                </div>
                                            </div>
                                       </form>



                                    </div>
                                 </div>
                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </div>


    <script>

function age(){
            var byear = document.getElementById('dateofbirth').value;
            var newbyear = byear.substring(0, byear.length - 6);
            var by = parseInt(newbyear);
            var currentYear= new Date().getFullYear();
            var ncy = parseInt(currentYear);
            var age = ncy - newbyear ;

            if (age < 10 ) {
                alert("Sorry, this age cannot be considered for registration!");
                Swal.fire('Hi, Your age '+ age);

                event.preventDefault();
            }else if( age > 45){
                alert("Ooops!, this age is considered too old for registration!");
                Swal.fire('Hi, Your age '+ age);
                event.preventDefault();

            } else{
                return true;
            }

            //console.log(byear);

            }

           function showage(){
            var byear = document.getElementById('dateofbirth').value;
            var newbyear = byear.substring(0, byear.length - 6);
            var by = parseInt(newbyear);
            var currentYear= new Date().getFullYear();
            var ncy = parseInt(currentYear);
            var age = ncy - newbyear ;

            if (age < 10 ) {
                //alert("Sorry, this age cannot be concidered!");
                document.getElementById("age1").style.color = "red";
                document.getElementById("age1").value = age + " ...This age cannot be considered for registration";
                //return false;
            }
            else if( age > 45){

                document.getElementById("age1").style.color = "blue";
                document.getElementById("age1").value = age + " ...This age is considered too old for registration";

            }else{
                //return true;
                document.getElementById("age1").style.color = "green";
                document.getElementById("age1").value = age;
            }


            }
        function check(id){

            var id = id;
            var spinner = $('#loader');

          Swal.fire({
          title: 'Are you sure?',
          text: "Deleting this record will affect other associated records (e.g Any Record where student is featured)",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            spinner.show();
            $.ajax({

                url: 'ajaxstudentdelete/'+id,
                async: false,
                type: "DELETE",
                cache: false,
                data:{
                    _token:'{{ csrf_token() }}',
                   id: id
                },
                dataType: 'JSON',

            }).done(function(resp) {
          spinner.hide();

            });
            Swal.fire(
              'Deleted!',
              'This Record is now  Deleted. You can Check Other Records to make neccessary Editing!',
              'success'
            )

            var myobj = document.getElementById("sid"+id);
             myobj.remove();

          }
        })

        }
        </script>
    @endsection
