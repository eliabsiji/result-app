@extends('layouts.master')
@section('content')


<div class="content">
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
        <div class="content-header">

            <div class="leftside-content-header">
                <ul class="breadcrumbs">
                    <li><i class="fa fa-columns" aria-hidden="true"></i><a href="{{ route('staff.index') }}">Staff Management</a></li>
                    <li><a>Add New Staff</a></li>
                </ul>
            </div>
        </div>
        @if (\Session::has('status'))
        <div class="alert alert-warning fade in">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
                <p>{{ \Session::get('status') }}</p>
            </div>
        @endif
            @if (\Session::has('success'))
        <div class="alert alert-warning fade in">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
                <p>{{ \Session::get('success') }}</p>
            </div>
        @endif
        <div class="row animated fadeInUp">
                @if (count($errors) > 0)
        <div class="alert alert-warning fade in">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>Opps!</strong> Something went wrong, please check below errors.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
            <div class="col-sm-12 col-md-8 col-md-offset-2">
                <span class="float-right">
                <a class="btn btn-primary" href="{{ route('staff.index') }}"> Back to Staff Management</a>
            </span>


            </div>
            <div class="row animated fadeInUp">
                <div class="col-sm-12">

                    <div class="panel">
                        <div class="panel-content">
                            <div class="row">

                                <div class="col-md-12">

                                    <div class="tabs">
                                        <ul class="nav nav-tabs nav-justified">
                                            <li class="active"><a href="#biodata" data-toggle="tab">Staff Bio Data</a></li>
                                            <li><a href="#academicdata" data-toggle="tab">Staff Academic Data</a></li>
                                            <li><a href="#assignedsubject" data-toggle="tab">Assigned Subject(s) & Class(es)</a></li>
                                            <li><a href="#profilepicture" data-toggle="tab">Profile Picture Upload </a></li>
                                            <li><a href="#staffprofile" data-toggle="tab">Staff Profile</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane fade in active" id="biodata">



                                                {!! Form::model($staff, ['route' => ['staff.update', $staff2->id], 'method'=>'PATCH','class'=>'form-horizontal form-stripe']) !!}
                                                        <h6 class="mb-xlg text-center"><b>Create Staff BioData Info</b></h6>
                                                        <div class="form-group">
                                                            <label for="name" class="col-sm-2 control-label">Name</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" class="form-control"  name="name" id="name"  placeholder="Name" value="{{ $staff2->name }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="password3" class="col-sm-2 control-label">Title </label>
                                                            <div class="col-sm-6 form-inline">
                                                                <select  class="form-control" name="title" id="title">
                                                                    @if ($staff->title == "")
                                                                        <option value="">Select Title </option>
                                                                    @else
                                                                    <option value="{{ $staff->title }}">Select Title </option>
                                                                    @endif
                                                                    <option value="Mr">Mr</option>
                                                                    <option value="Mrs">Mrs</option>
                                                                    <option value="Miss">Miss</option>
                                                                </select> ({{ $staff->title }})

                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name" class="col-sm-2 control-label">Employment ID</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" class="form-control"  name="employmentid" id="employmentid" required placeholder="Employment Id" value="{{ $staff->employmentid }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="username" class="col-sm-2 control-label">Phone Number</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" class="form-control"  name="phonenumber" id="phonenumber" required placeholder="Phone Number" value="{{ $staff->phonenumber }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email3" class="col-sm-2 control-label">Email</label>
                                                            <div class="col-sm-6">
                                                                <input type="email" class="form-control" name="email" id="email" required placeholder="Email" value="{{ $staff2->email }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="password3" class="col-sm-2 control-label">Gender </label>
                                                            <div class="col-sm-6 form-inline">
                                                                <select  class="form-control" name="gender" id="gender">
                                                                    @if ($staff->gender == "")
                                                                        <option value="">Select Gender </option>
                                                                    @else
                                                                    <option value="{{ $staff->gender }}">Select Gender </option>
                                                                    @endif

                                                                    <option value="Male">Male</option>
                                                                    <option value="Female">Female</option>
                                                                </select> ({{ $staff->gender }})

                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="password3" class="col-sm-2 control-label">Marital Status </label>
                                                            <div class="col-sm-6 form-inline">
                                                                <select  class="form-control" name="maritalstatus" id="maritalstatus">
                                                                    @if ($staff->maritalstatus == "")
                                                                        <option value="">Select Marital Status </option>
                                                                    @else
                                                                    <option value="{{ $staff->maritalstatus }}">Select Marital Status </option>
                                                                    @endif

                                                                    <option value="Married">Married</option>
                                                                    <option value="Divorced">Divorced</option>
                                                                    <option value="single">Single<option>
                                                                    <option value="Widow">Widow<option>
                                                                    <option value="widower">Widower </option>
                                                                </select> ({{ $staff->maritalstatus }})

                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email3" class="col-sm-2 control-label">Number of Children</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" class="form-control"  name="numberofchildren" id="numberofchildren" required placeholder="Number of Children" value="{{ $staff->numberofchildren }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email3" class="col-sm-2 control-label">Spouse Phone Number</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" class="form-control" name="spousenumber" id="spousenumber" required placeholder="Spouse Phone Number" value="{{ $staff->spousenumber}}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email3" class="col-sm-2 control-label">Home Address</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" class="form-control" name="address" id="address" required placeholder="Home Address" value="{{ $staff->address }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email3" class="col-sm-2 control-label">Nationality</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" class="form-control" name="nationality" id="nationality" required placeholder="nationality" value="{{ $staff->nationality}}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="password3" class="col-sm-2 control-label">State</label>
                                                            <div class="col-sm-6 form-inline">
                                                                <select  class="form-control" id="state" data-rel="chosen" name="state" required>
                                                                    @if ($staff->state == -1)
                                                                    <option value="{{ $staff->state }}" selected>{{ $staff->state }}</option>
                                                                @else
                                                                <option value="{{ $staff->state }}" selected>Select State </option>
                                                                @endif

                                                                </select> ({{ $staff->state }})

                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="password3" class="col-sm-2 control-label">Local Goverment</label>
                                                            <div class="col-sm-6 form-inline">
                                                                <select  class="form-control" id="local" data-rel="chosen" name="local" required>
                                                                    @if ($staff->local == "")
                                                                    <option value="" selected>Select Local </option>
                                                                @else
                                                                <option value="{{ $staff->local }}" select>Select Local </option>
                                                                @endif

                                                                </select> ({{ $staff->local }})

                                                            </div>
                                                        </div>
                                                        <script language="javascript">
                                                            populateCountries("state", "local");
                                                        </script>
                                                        <div class="form-group">
                                                            <label for="password3" class="col-sm-2 control-label">Religion</label>
                                                            <div class="col-sm-6 form-inline">
                                                                <select  class="form-control" id="religion" data-rel="chosen" name="religion" required>
                                                                    @if ($staff->religion == "")
                                                                    <option value="" selected>Select Religion </option>
                                                                @else
                                                                <option value="{{ $staff->religion }}" selected>Select Religion</option>
                                                                @endif

                                                                    <option value="Christianity">Christianity</option>
                                                                    <option value="Islam">Islam</option>
                                                                    <option value="others">Others</option>
                                                                </select> ({{ $staff->religion }})

                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email3" class="col-sm-2 control-label">Date of Birth</label>
                                                            <div class="col-sm-3">
                                                                <input type="date" class="form-control" name="dateofbirth" id="dateofbirth" required placeholder="birthofbirth" value="{{ $staff->dateofbirth}}">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="col-sm-offset-2 col-sm-10">
                                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                            </div>
                                                        </div>


                                                     {!! Form::close() !!}




                                            </div>
                                            <div class="tab-pane fade" id="academicdata">

                                                <div class="col-sm-12">
                                                    <div class="panel">
                                                        <div class="panel-header">
                                                            <h3 class="panel-title">Academic Qualification 1</h3>
                                                            <div class="panel-actions">

                                                            </div>
                                                        </div>
                                                        <div class="panel-content">


                                                            {!! Form::model($staff, ['route' => ['staffacademicinfo.update', $staff2->id], 'method'=>'PATCH','class'=>'form-horizontal form-stripe']) !!}

                                                            <div class="form-group">
                                                                <label for="name" class="col-sm-2 control-label">Name of Institution</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" class="form-control"  name="institution" id="institution"  placeholder="Name of Institution" value="{{ $acad1->institution }}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="name" class="col-sm-2 control-label">Discipline</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" class="form-control"  name="discipline" id="discipline" required placeholder="Discipline" value="{{ $acad1->discipline }}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="username" class="col-sm-2 control-label">Qualification</label>
                                                                <div class="col-sm-3">
                                                                    <select  class="form-control" name="qualification" id="qualifiaction">
                                                                        @if ($acad1->qualification == "")
                                                                            <option value="">Select Qualification </option>
                                                                        @else
                                                                        <option value="{{ $acad1->qualification }}">Select  </option>
                                                                        @endif

                                                                        <option value="Senior School Certificate">   Senior School Certificate</option>
                                                                        <option value="West African GCE O Level">  West African GCE "O" Level</option>
                                                                        <option value="West African GCE A Level">  West African GCE "A" Level</option>
                                                                        <option value="National Diploma">  National Diploma</option>
                                                                        <option value="Bachelor's Degree">  Bachelor's Degree</option>
                                                                        <option value="Higher National Diploma">  Higher National Diploma</option>
                                                                        <option value="Bachelor Honours Degree">  Bachelor Honours Degree</option>
                                                                        <option value="Doctor of Veterinary Medicine">  Doctor of Veterinary Medicine</option>
                                                                        <option value="Postgraduate Diploma">  Postgraduate Diploma</option>
                                                                        <option value="Master's Degree">  Master's Degree</option>
                                                                        <option value="{Master of Philosophy">  Master of Philosophy</option>
                                                                        <option value="Doctor of Philosophy">  Doctor of Philosophy</option>
                                                                     </select> ({{ $acad1->qualification }})


                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="email3" class="col-sm-2 control-label">Year</label>
                                                                <div class="col-sm-6">
                                                                    <input type="date" class="form-control" name="year" id="year" required placeholder="Year Obtained" value="{{ $acad1->year }}">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="email3" class="col-sm-2 control-label">Year Of Experience</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" class="form-control" name="yearteaching" id="year" required placeholder="Indicate Years of Teaching Experience" value="{{ $acad1->yearteaching }}">
                                                                </div>
                                                            </div>



                                                            <div class="panel-header">
                                                                <h3 class="panel-title">Academic Qualification 2</h3>
                                                            </div>


                                                            <div class="form-group">
                                                                <label for="name" class="col-sm-2 control-label">Name of Institution</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" class="form-control"  name="institution2" id="institution2"  placeholder="Name of Institution" value="{{ $acad2->institution2 }}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="name" class="col-sm-2 control-label">Discipline</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" class="form-control"  name="discipline2" id="discipline2" required placeholder="Discipline" value="{{ $acad2->discipline2 }}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="username" class="col-sm-2 control-label">Qualification</label>
                                                                <div class="col-sm-3">
                                                                    <select  class="form-control" name="qualification2" id="qualifiaction2">
                                                                        @if ($acad2->qualification2 == "")
                                                                            <option value="">Select Qualification </option>
                                                                        @else
                                                                        <option value="{{ $acad2->qualification2 }}">Select  </option>
                                                                        @endif

                                                                        <option value="Senior School Certificate">   Senior School Certificate</option>
                                                                        <option value="West African GCE O Level">  West African GCE "O" Level</option>
                                                                        <option value="West African GCE A Level">  West African GCE "A" Level</option>
                                                                        <option value="National Diploma">  National Diploma</option>
                                                                        <option value="Bachelor's Degree">  Bachelor's Degree</option>
                                                                        <option value="Higher National Diploma">  Higher National Diploma</option>
                                                                        <option value="Bachelor Honours Degree">  Bachelor Honours Degree</option>
                                                                        <option value="Doctor of Veterinary Medicine">  Doctor of Veterinary Medicine</option>
                                                                        <option value="Postgraduate Diploma">  Postgraduate Diploma</option>
                                                                        <option value="Master's Degree">  Master's Degree</option>
                                                                        <option value="{Master of Philosophy">  Master of Philosophy</option>
                                                                        <option value="Doctor of Philosophy">  Doctor of Philosophy</option>
                                                                     </select> ({{ $acad2->qualification2 }})


                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="email3" class="col-sm-2 control-label">Year</label>
                                                                <div class="col-sm-6">
                                                                    <input type="date" class="form-control" name="year2" id="year2" required placeholder="Year Obtained" value="{{ $acad2->year2 }}">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="email3" class="col-sm-2 control-label">Year Of Experience</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" class="form-control" name="yearteaching2" id="year2" required placeholder="Indicate Years of Teaching Experience" value="{{ $acad2->yearteaching2 }}">
                                                                </div>
                                                            </div>




                                                            <div class="panel-header">
                                                                <h3 class="panel-title">Academic Qualification 3</h3>
                                                            </div>


                                                            <div class="form-group">
                                                                <label for="name" class="col-sm-2 control-label">Name of Institution</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" class="form-control"  name="institution3" id="institution3"  placeholder="Name of Institution" value="{{ $acad3->institution3 }}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="name" class="col-sm-2 control-label">Discipline</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" class="form-control"  name="discipline3" id="discipline3" required placeholder="Discipline" value="{{ $acad3->discipline3 }}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="username" class="col-sm-2 control-label">Qualification</label>
                                                                <div class="col-sm-3">
                                                                    <select  class="form-control" name="qualification3" id="qualifiaction3">
                                                                        @if ($acad3->qualification3 == "")
                                                                            <option value="">Select Qualification </option>
                                                                        @else
                                                                        <option value="{{ $acad3->qualification3 }}">Select  </option>
                                                                        @endif

                                                                        <option value="Senior School Certificate">   Senior School Certificate</option>
                                                                        <option value="West African GCE O Level">  West African GCE "O" Level</option>
                                                                        <option value="West African GCE A Level">  West African GCE "A" Level</option>
                                                                        <option value="National Diploma">  National Diploma</option>
                                                                        <option value="Bachelor's Degree">  Bachelor's Degree</option>
                                                                        <option value="Higher National Diploma">  Higher National Diploma</option>
                                                                        <option value="Bachelor Honours Degree">  Bachelor Honours Degree</option>
                                                                        <option value="Doctor of Veterinary Medicine">  Doctor of Veterinary Medicine</option>
                                                                        <option value="Postgraduate Diploma">  Postgraduate Diploma</option>
                                                                        <option value="Master's Degree">  Master's Degree</option>
                                                                        <option value="{Master of Philosophy">  Master of Philosophy</option>
                                                                        <option value="Doctor of Philosophy">  Doctor of Philosophy</option>
                                                                     </select> ({{ $acad3->qualification3 }})


                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="email3" class="col-sm-2 control-label">Year</label>
                                                                <div class="col-sm-6">
                                                                    <input type="date" class="form-control" name="year3" id="year3" required placeholder="Year Obtained" value="{{ $acad3->year3 }}">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="email3" class="col-sm-2 control-label">Year Of Experience</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" class="form-control" name="yearteaching3" id="year3" required placeholder="Indicate Years of Teaching Experience" value="{{ $acad3->yearteaching3 }}">
                                                                </div>
                                                            </div>






                                                            <div class="form-group">
                                                                <div class="col-sm-offset-2 col-sm-10">
                                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                                </div>
                                                            </div>
                                                         {!! Form::close() !!}
                                                        </div>
                                                    </div>
                                                </div>




                                            </div>
                                            <div class="tab-pane fade" id="assignedsubject">
                                                <p><b>Message</b> content</p>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae tellus tincidunt, mattis odio eu, accumsan quam. Duis ultricies, erat nec suscipit mattis, risus est efficitur enim, sed finibus lacus nisi et mauris. Ut sed accumsan ipsum. Aliquam vel nibh et turpis euismod porttitor. In diam odio, cursus eget faucibus quis, efficitur id erat. Aliquam euismod in justo sit amet ornare. Quisque eu fringilla libero. Donec iaculis sit amet nibh non laoreet.
                                                </p>
                                            </div>
                                            <div class="tab-pane fade" id="profilepicture">

                                                <div  allign="center">
                                                    <img id="preview_img" src="{{ asset('asset/student_pix/unnamed.png') }}" class="img-circle thumbnail" width="112" height="109" />
                                                    <div class="form-group  col-md-4">
                                                      <label for="exampleInputPassword1">Upload Profile Picture</label>
                                                      {!! Form::model($staff, ['route' => ['staffacademicinfo.update', $staff2->id], 'method'=>'PATCH','class'=>'form-horizontal form-stripe']) !!}
                                                        <input type="file" id="avatar" name="avatar" onchange="readURL(this);">
                                                       {!! Form::close() !!}
                                                      <script type="text/javascript">
                                                        function readURL(input) {
                                                          if (input.files && input.files[0] ) {
                                                            var reader = new FileReader();

                                                            reader.onload = function (e) {
                                                                $('#preview_img').attr('src', e.target.result);
                                                            }

                                                            reader.readAsDataURL(input.files[0]);
                                                           }
                                                          }
                                                         </script>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="tab-pane fade" id="staffprofile">
                                                <p><b>Settings</b> content</p>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae tellus tincidunt, mattis odio eu, accumsan quam. Duis ultricies, erat nec suscipit mattis, risus est efficitur enim, sed finibus lacus nisi et mauris. Ut sed accumsan ipsum. Aliquam vel nibh et turpis euismod porttitor. In diam odio, cursus eget faucibus quis, efficitur id erat. Aliquam euismod in justo sit amet ornare. Quisque eu fringilla libero. Donec iaculis sit amet nibh non laoreet.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @endsection
