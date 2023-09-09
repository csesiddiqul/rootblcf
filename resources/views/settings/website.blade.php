@extends('layouts.app')

@section('title', __('Academic Settings'))

@section('content')
    @component('components.cropper.website',['type'=>'square','table_name'=>'settings','table_id'=>$setting->id]) @endcomponent
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('school.website').'">'. trans('Website Settings').'</a>'])
                @include('components.sectionbar.frontmanagement-bar')
                <div class="clearhight"></div>
                <div class="panel-group">
                    <div class="col-md-6 pl-0 pr-0 ex-w-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">@lang('Basic Info')</div>
                            <div class="panel-body">
                                <table class="table table-responsive">
                                    <tbody>
                                    <tr>
                                        <td width="30%">@lang('Name')</td>
                                        <td>
                                            <a href="javascript:void(0)"
                                               class="required editable editable-click"
                                               data-name="name"
                                               data-type="text" data-pk="1" data-source=""
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting['school']->name }}"
                                               data-value="{{ $setting['school']->name }}" data-original-title=""
                                               title="@lang('School Name')">{{ $setting['school']->name }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Short Name')</td>
                                        <td>
                                            <a href="javascript:void(0)"
                                               class="required editable editable-click"
                                               data-name="short_name"
                                               data-type="text" data-pk="1" data-source=""
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting['school']->short_name }}"
                                               data-value="{{ $setting['school']->short_name }}" data-original-title=""
                                               title="@lang('School Short Name')">{{ $setting['school']->short_name }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Secret key')</td>
                                        <td>
                                            <strong> @lang('Teacher')</strong><span style="padding: 10px">:</span><code
                                                    class="secret_key">T{{$setting['school']->secretKey}}</code> <span
                                                    id="generate_secret_key"
                                                    class="btn-sm pull-right btn-link cursorP">@lang('Generate new')</span>
                                            <br>
                                            <strong> @lang('Staff')</strong><span
                                                    style="padding: 0px 10px 0px 33px;">:</span><code
                                                    class="secret_key_s">S{{$setting['school']->secretKey}}</code>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{transMsg('Web URL')}}</td>
                                        <td>{{auth()->user()->school->code}}.foqasacademy.com</td>
                                    </tr>
                                    <tr>
                                        <td>{{transMsg('Custom Website')}}</td>
                                        <td>
                                            @if(empty($letEcript->domain))
                                                <a href="javascript:void(0)"
                                                   class="required editable editable-click"
                                                   data-name="domain"
                                                   data-type="text" data-pk="3" data-source=""
                                                   data-url="{{ route('setting.update') }}"
                                                   data-title=""
                                                   data-value="" data-original-title=""
                                                   title="{{transMsg('Enter your domain name')}}"></a>
                                            @else
                                                @if (isset($letEcript->domain))
                                                    <a href="https://{{$letEcript->domain}}"
                                                       target="_blank">{{$letEcript->domain}}</a>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                    {{--       <tr>
                                           <td>{{transMsg('Https Status')}}</td>
                                           <td>
                                               @if (isset($letEcript->status))
                                                   @if ($letEcript->status == 'valid')
                                                       @php $label='success';$secure = transMsg('Secure'); @endphp
                                                   @else
                                                       @php $label='danger';$secure = transMsg('Not Secure'); @endphp
                                                   @endif
                                                   <spna class="label label-{{$label}}">{{$secure}}</spna>
                                               @else
                                                   <spna class="label label-danger">{{transMsg('Not Secure')}}</spna>
                                               @endif
                                           </td>
                                       </tr>
                                       <tr>
                                           <td>@lang('Secure website')</td>
                                           <td>
                                               @if (isset($letEcript->status))
                                                   @if ($letEcript->status == 'domain_added' || $letEcript->status != 'valid'  && isset($letEcript->domain))
                                                       <a class="btn btn-xs btn-info"
                                                          id="securenow">@lang('Secure with Lets Encript')</a>
                                                   @else
                                                       @lang('Your domain is already secured!')
                                                   @endif
                                               @else
                                                   @lang('Please add your Custom domain first!')
                                               @endif
                                           </td>
                                       </tr>--}}
                                    <tr>
                                        <td>@lang('Tag Line')</td>
                                        <td>
                                            <a href="javascript:void(0)" class="fied-required editable editable-click"
                                               data-name="slogan"
                                               data-type="text" data-pk="2" data-source=""
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting->slogan }}"
                                               data-value="{{ $setting->slogan  }}" data-original-title=""
                                               title="@lang('Slogan')">{{ $setting->slogan  }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('EIIN Number')</td>
                                        <td>
                                            <a href="javascript:void(0)" class="fied-required editable editable-click"
                                               data-name="eiin"
                                               data-type="text" data-pk="2" data-source=""
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting->eiin }}"
                                               data-value="{{ $setting->eiin  }}" data-original-title=""
                                               title="@lang('EIIN Number')">{{ $setting->eiin  }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('School Code')</td>
                                        <td>
                                            <a href="javascript:void(0)" class="fied-required editable editable-click"
                                               data-name="branch_code"
                                               data-type="text" data-pk="1" data-source=""
                                               data-url="{{ route('setting.update')}}"
                                               data-title="{{ $setting['school']->branch_code}}"
                                               data-value="{{ $setting['school']->branch_code }}" data-original-title=""
                                               title="@lang('School Code')">{{ $setting['school']->branch_code }}</a>
                                        </td>
                                    </tr>
                                   {{-- <tr>
                                        <td>@lang('Medium')</td>
                                        <td>
                                            <a href="javascript:void(0)" class="fied-required editable editable-click"
                                               data-name="medium"
                                               data-type="select" data-pk="1"
                                               data-source="{{ json_encode(['bangla'=>'Bangla','english'=>'English']) }}"
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting['school']->medium }}"
                                               data-value="{{ $setting['school']->medium }}" data-original-title=""
                                               title="@lang('School Medium')"></a>
                                        </td>
                                    </tr>--}}
                                    <tr>
                                        <td>@lang('Highlights Counter')</td>
                                        <td>
                                            <a href="javascript:void(0)" class="fied-required editable editable-click"
                                               data-name="home_counter"
                                               data-type="select" data-pk="2"
                                               data-source="{{ json_encode(['1'=>'Yes','0'=>'No']) }}"
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting->home_counter }}"
                                               data-value="{{ $setting->home_counter }}" data-original-title=""
                                               title="@lang('Highlights Counter')"></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Established')</td>
                                        <td>
                                            <a href="javascript:void(0)"
                                               class="popupBottom fied-required editable editable-click"
                                               data-name="established"
                                               data-type="combodate" data-pk="1" data-source=""
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting['school']->established }}"
                                               data-value="{{ $setting['school']->established }}" data-original-title=""
                                               title="@lang('School Established')">{{ $setting['school']->established }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Language')</td>
                                        <td>
                                            <a href="javascript:void(0)" class="fied-required editable editable-click"
                                               data-name="language"
                                               data-type="select" data-pk="2"
                                               data-source="{{ json_encode(['bn'=>'Bangla','en'=>'English']) }}"
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting->language }}"
                                               data-value="{{ $setting->language }}" data-original-title=""
                                               title="@lang('Language')">{{$setting->language == 'bn' ? 'Bangla' : 'English'}}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Country')</td>
                                        <td>
                                            <a href="javascript:void(0)" class="fied-required editable editable-click"
                                               data-name="country_id" data-source="{{json_encode($country)}}"
                                               data-type="select" data-pk="1"
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ getCountryName($setting['school']->country_id)}}"
                                               data-value="{{ $setting['school']->country_id }}" data-original-title=""
                                               title="@lang('Country')">{{ getCountryName($setting['school']->country_id) }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Timezone')</td>
                                        <td>
                                            <a href="javascript:void(0)" class="fied-required editable editable-click"
                                               data-name="timezone"
                                               data-type="select" data-pk="2"
                                               data-source="{&quot;Africa\/Abidjan&quot;:&quot;Africa\/Abidjan&quot;,&quot;Africa\/Accra&quot;:&quot;Africa\/Accra&quot;,&quot;Africa\/Addis_Ababa&quot;:&quot;Africa\/Addis_Ababa&quot;,&quot;Africa\/Algiers&quot;:&quot;Africa\/Algiers&quot;,&quot;Africa\/Asmara&quot;:&quot;Africa\/Asmara&quot;,&quot;Africa\/Bamako&quot;:&quot;Africa\/Bamako&quot;,&quot;Africa\/Bangui&quot;:&quot;Africa\/Bangui&quot;,&quot;Africa\/Banjul&quot;:&quot;Africa\/Banjul&quot;,&quot;Africa\/Bissau&quot;:&quot;Africa\/Bissau&quot;,&quot;Africa\/Blantyre&quot;:&quot;Africa\/Blantyre&quot;,&quot;Africa\/Brazzaville&quot;:&quot;Africa\/Brazzaville&quot;,&quot;Africa\/Bujumbura&quot;:&quot;Africa\/Bujumbura&quot;,&quot;Africa\/Cairo&quot;:&quot;Africa\/Cairo&quot;,&quot;Africa\/Casablanca&quot;:&quot;Africa\/Casablanca&quot;,&quot;Africa\/Ceuta&quot;:&quot;Africa\/Ceuta&quot;,&quot;Africa\/Conakry&quot;:&quot;Africa\/Conakry&quot;,&quot;Africa\/Dakar&quot;:&quot;Africa\/Dakar&quot;,&quot;Africa\/Dar_es_Salaam&quot;:&quot;Africa\/Dar_es_Salaam&quot;,&quot;Africa\/Djibouti&quot;:&quot;Africa\/Djibouti&quot;,&quot;Africa\/Douala&quot;:&quot;Africa\/Douala&quot;,&quot;Africa\/El_Aaiun&quot;:&quot;Africa\/El_Aaiun&quot;,&quot;Africa\/Freetown&quot;:&quot;Africa\/Freetown&quot;,&quot;Africa\/Gaborone&quot;:&quot;Africa\/Gaborone&quot;,&quot;Africa\/Harare&quot;:&quot;Africa\/Harare&quot;,&quot;Africa\/Johannesburg&quot;:&quot;Africa\/Johannesburg&quot;,&quot;Africa\/Juba&quot;:&quot;Africa\/Juba&quot;,&quot;Africa\/Kampala&quot;:&quot;Africa\/Kampala&quot;,&quot;Africa\/Khartoum&quot;:&quot;Africa\/Khartoum&quot;,&quot;Africa\/Kigali&quot;:&quot;Africa\/Kigali&quot;,&quot;Africa\/Kinshasa&quot;:&quot;Africa\/Kinshasa&quot;,&quot;Africa\/Lagos&quot;:&quot;Africa\/Lagos&quot;,&quot;Africa\/Libreville&quot;:&quot;Africa\/Libreville&quot;,&quot;Africa\/Lome&quot;:&quot;Africa\/Lome&quot;,&quot;Africa\/Luanda&quot;:&quot;Africa\/Luanda&quot;,&quot;Africa\/Lubumbashi&quot;:&quot;Africa\/Lubumbashi&quot;,&quot;Africa\/Lusaka&quot;:&quot;Africa\/Lusaka&quot;,&quot;Africa\/Malabo&quot;:&quot;Africa\/Malabo&quot;,&quot;Africa\/Maputo&quot;:&quot;Africa\/Maputo&quot;,&quot;Africa\/Maseru&quot;:&quot;Africa\/Maseru&quot;,&quot;Africa\/Mbabane&quot;:&quot;Africa\/Mbabane&quot;,&quot;Africa\/Mogadishu&quot;:&quot;Africa\/Mogadishu&quot;,&quot;Africa\/Monrovia&quot;:&quot;Africa\/Monrovia&quot;,&quot;Africa\/Nairobi&quot;:&quot;Africa\/Nairobi&quot;,&quot;Africa\/Ndjamena&quot;:&quot;Africa\/Ndjamena&quot;,&quot;Africa\/Niamey&quot;:&quot;Africa\/Niamey&quot;,&quot;Africa\/Nouakchott&quot;:&quot;Africa\/Nouakchott&quot;,&quot;Africa\/Ouagadougou&quot;:&quot;Africa\/Ouagadougou&quot;,&quot;Africa\/Porto-Novo&quot;:&quot;Africa\/Porto-Novo&quot;,&quot;Africa\/Sao_Tome&quot;:&quot;Africa\/Sao_Tome&quot;,&quot;Africa\/Tripoli&quot;:&quot;Africa\/Tripoli&quot;,&quot;Africa\/Tunis&quot;:&quot;Africa\/Tunis&quot;,&quot;Africa\/Windhoek&quot;:&quot;Africa\/Windhoek&quot;,&quot;America\/Adak&quot;:&quot;America\/Adak&quot;,&quot;America\/Anchorage&quot;:&quot;America\/Anchorage&quot;,&quot;America\/Anguilla&quot;:&quot;America\/Anguilla&quot;,&quot;America\/Antigua&quot;:&quot;America\/Antigua&quot;,&quot;America\/Araguaina&quot;:&quot;America\/Araguaina&quot;,&quot;America\/Argentina\/Buenos_Aires&quot;:&quot;America\/Argentina\/Buenos_Aires&quot;,&quot;America\/Argentina\/Catamarca&quot;:&quot;America\/Argentina\/Catamarca&quot;,&quot;America\/Argentina\/Cordoba&quot;:&quot;America\/Argentina\/Cordoba&quot;,&quot;America\/Argentina\/Jujuy&quot;:&quot;America\/Argentina\/Jujuy&quot;,&quot;America\/Argentina\/La_Rioja&quot;:&quot;America\/Argentina\/La_Rioja&quot;,&quot;America\/Argentina\/Mendoza&quot;:&quot;America\/Argentina\/Mendoza&quot;,&quot;America\/Argentina\/Rio_Gallegos&quot;:&quot;America\/Argentina\/Rio_Gallegos&quot;,&quot;America\/Argentina\/Salta&quot;:&quot;America\/Argentina\/Salta&quot;,&quot;America\/Argentina\/San_Juan&quot;:&quot;America\/Argentina\/San_Juan&quot;,&quot;America\/Argentina\/San_Luis&quot;:&quot;America\/Argentina\/San_Luis&quot;,&quot;America\/Argentina\/Tucuman&quot;:&quot;America\/Argentina\/Tucuman&quot;,&quot;America\/Argentina\/Ushuaia&quot;:&quot;America\/Argentina\/Ushuaia&quot;,&quot;America\/Aruba&quot;:&quot;America\/Aruba&quot;,&quot;America\/Asuncion&quot;:&quot;America\/Asuncion&quot;,&quot;America\/Atikokan&quot;:&quot;America\/Atikokan&quot;,&quot;America\/Bahia&quot;:&quot;America\/Bahia&quot;,&quot;America\/Bahia_Banderas&quot;:&quot;America\/Bahia_Banderas&quot;,&quot;America\/Barbados&quot;:&quot;America\/Barbados&quot;,&quot;America\/Belem&quot;:&quot;America\/Belem&quot;,&quot;America\/Belize&quot;:&quot;America\/Belize&quot;,&quot;America\/Blanc-Sablon&quot;:&quot;America\/Blanc-Sablon&quot;,&quot;America\/Boa_Vista&quot;:&quot;America\/Boa_Vista&quot;,&quot;America\/Bogota&quot;:&quot;America\/Bogota&quot;,&quot;America\/Boise&quot;:&quot;America\/Boise&quot;,&quot;America\/Cambridge_Bay&quot;:&quot;America\/Cambridge_Bay&quot;,&quot;America\/Campo_Grande&quot;:&quot;America\/Campo_Grande&quot;,&quot;America\/Cancun&quot;:&quot;America\/Cancun&quot;,&quot;America\/Caracas&quot;:&quot;America\/Caracas&quot;,&quot;America\/Cayenne&quot;:&quot;America\/Cayenne&quot;,&quot;America\/Cayman&quot;:&quot;America\/Cayman&quot;,&quot;America\/Chicago&quot;:&quot;America\/Chicago&quot;,&quot;America\/Chihuahua&quot;:&quot;America\/Chihuahua&quot;,&quot;America\/Costa_Rica&quot;:&quot;America\/Costa_Rica&quot;,&quot;America\/Creston&quot;:&quot;America\/Creston&quot;,&quot;America\/Cuiaba&quot;:&quot;America\/Cuiaba&quot;,&quot;America\/Curacao&quot;:&quot;America\/Curacao&quot;,&quot;America\/Danmarkshavn&quot;:&quot;America\/Danmarkshavn&quot;,&quot;America\/Dawson&quot;:&quot;America\/Dawson&quot;,&quot;America\/Dawson_Creek&quot;:&quot;America\/Dawson_Creek&quot;,&quot;America\/Denver&quot;:&quot;America\/Denver&quot;,&quot;America\/Detroit&quot;:&quot;America\/Detroit&quot;,&quot;America\/Dominica&quot;:&quot;America\/Dominica&quot;,&quot;America\/Edmonton&quot;:&quot;America\/Edmonton&quot;,&quot;America\/Eirunepe&quot;:&quot;America\/Eirunepe&quot;,&quot;America\/El_Salvador&quot;:&quot;America\/El_Salvador&quot;,&quot;America\/Fort_Nelson&quot;:&quot;America\/Fort_Nelson&quot;,&quot;America\/Fortaleza&quot;:&quot;America\/Fortaleza&quot;,&quot;America\/Glace_Bay&quot;:&quot;America\/Glace_Bay&quot;,&quot;America\/Goose_Bay&quot;:&quot;America\/Goose_Bay&quot;,&quot;America\/Grand_Turk&quot;:&quot;America\/Grand_Turk&quot;,&quot;America\/Grenada&quot;:&quot;America\/Grenada&quot;,&quot;America\/Guadeloupe&quot;:&quot;America\/Guadeloupe&quot;,&quot;America\/Guatemala&quot;:&quot;America\/Guatemala&quot;,&quot;America\/Guayaquil&quot;:&quot;America\/Guayaquil&quot;,&quot;America\/Guyana&quot;:&quot;America\/Guyana&quot;,&quot;America\/Halifax&quot;:&quot;America\/Halifax&quot;,&quot;America\/Havana&quot;:&quot;America\/Havana&quot;,&quot;America\/Hermosillo&quot;:&quot;America\/Hermosillo&quot;,&quot;America\/Indiana\/Indianapolis&quot;:&quot;America\/Indiana\/Indianapolis&quot;,&quot;America\/Indiana\/Knox&quot;:&quot;America\/Indiana\/Knox&quot;,&quot;America\/Indiana\/Marengo&quot;:&quot;America\/Indiana\/Marengo&quot;,&quot;America\/Indiana\/Petersburg&quot;:&quot;America\/Indiana\/Petersburg&quot;,&quot;America\/Indiana\/Tell_City&quot;:&quot;America\/Indiana\/Tell_City&quot;,&quot;America\/Indiana\/Vevay&quot;:&quot;America\/Indiana\/Vevay&quot;,&quot;America\/Indiana\/Vincennes&quot;:&quot;America\/Indiana\/Vincennes&quot;,&quot;America\/Indiana\/Winamac&quot;:&quot;America\/Indiana\/Winamac&quot;,&quot;America\/Inuvik&quot;:&quot;America\/Inuvik&quot;,&quot;America\/Iqaluit&quot;:&quot;America\/Iqaluit&quot;,&quot;America\/Jamaica&quot;:&quot;America\/Jamaica&quot;,&quot;America\/Juneau&quot;:&quot;America\/Juneau&quot;,&quot;America\/Kentucky\/Louisville&quot;:&quot;America\/Kentucky\/Louisville&quot;,&quot;America\/Kentucky\/Monticello&quot;:&quot;America\/Kentucky\/Monticello&quot;,&quot;America\/Kralendijk&quot;:&quot;America\/Kralendijk&quot;,&quot;America\/La_Paz&quot;:&quot;America\/La_Paz&quot;,&quot;America\/Lima&quot;:&quot;America\/Lima&quot;,&quot;America\/Los_Angeles&quot;:&quot;America\/Los_Angeles&quot;,&quot;America\/Lower_Princes&quot;:&quot;America\/Lower_Princes&quot;,&quot;America\/Maceio&quot;:&quot;America\/Maceio&quot;,&quot;America\/Managua&quot;:&quot;America\/Managua&quot;,&quot;America\/Manaus&quot;:&quot;America\/Manaus&quot;,&quot;America\/Marigot&quot;:&quot;America\/Marigot&quot;,&quot;America\/Martinique&quot;:&quot;America\/Martinique&quot;,&quot;America\/Matamoros&quot;:&quot;America\/Matamoros&quot;,&quot;America\/Mazatlan&quot;:&quot;America\/Mazatlan&quot;,&quot;America\/Menominee&quot;:&quot;America\/Menominee&quot;,&quot;America\/Merida&quot;:&quot;America\/Merida&quot;,&quot;America\/Metlakatla&quot;:&quot;America\/Metlakatla&quot;,&quot;America\/Mexico_City&quot;:&quot;America\/Mexico_City&quot;,&quot;America\/Miquelon&quot;:&quot;America\/Miquelon&quot;,&quot;America\/Moncton&quot;:&quot;America\/Moncton&quot;,&quot;America\/Monterrey&quot;:&quot;America\/Monterrey&quot;,&quot;America\/Montevideo&quot;:&quot;America\/Montevideo&quot;,&quot;America\/Montserrat&quot;:&quot;America\/Montserrat&quot;,&quot;America\/Nassau&quot;:&quot;America\/Nassau&quot;,&quot;America\/New_York&quot;:&quot;America\/New_York&quot;,&quot;America\/Nipigon&quot;:&quot;America\/Nipigon&quot;,&quot;America\/Nome&quot;:&quot;America\/Nome&quot;,&quot;America\/Noronha&quot;:&quot;America\/Noronha&quot;,&quot;America\/North_Dakota\/Beulah&quot;:&quot;America\/North_Dakota\/Beulah&quot;,&quot;America\/North_Dakota\/Center&quot;:&quot;America\/North_Dakota\/Center&quot;,&quot;America\/North_Dakota\/New_Salem&quot;:&quot;America\/North_Dakota\/New_Salem&quot;,&quot;America\/Nuuk&quot;:&quot;America\/Nuuk&quot;,&quot;America\/Ojinaga&quot;:&quot;America\/Ojinaga&quot;,&quot;America\/Panama&quot;:&quot;America\/Panama&quot;,&quot;America\/Pangnirtung&quot;:&quot;America\/Pangnirtung&quot;,&quot;America\/Paramaribo&quot;:&quot;America\/Paramaribo&quot;,&quot;America\/Phoenix&quot;:&quot;America\/Phoenix&quot;,&quot;America\/Port-au-Prince&quot;:&quot;America\/Port-au-Prince&quot;,&quot;America\/Port_of_Spain&quot;:&quot;America\/Port_of_Spain&quot;,&quot;America\/Porto_Velho&quot;:&quot;America\/Porto_Velho&quot;,&quot;America\/Puerto_Rico&quot;:&quot;America\/Puerto_Rico&quot;,&quot;America\/Punta_Arenas&quot;:&quot;America\/Punta_Arenas&quot;,&quot;America\/Rainy_River&quot;:&quot;America\/Rainy_River&quot;,&quot;America\/Rankin_Inlet&quot;:&quot;America\/Rankin_Inlet&quot;,&quot;America\/Recife&quot;:&quot;America\/Recife&quot;,&quot;America\/Regina&quot;:&quot;America\/Regina&quot;,&quot;America\/Resolute&quot;:&quot;America\/Resolute&quot;,&quot;America\/Rio_Branco&quot;:&quot;America\/Rio_Branco&quot;,&quot;America\/Santarem&quot;:&quot;America\/Santarem&quot;,&quot;America\/Santiago&quot;:&quot;America\/Santiago&quot;,&quot;America\/Santo_Domingo&quot;:&quot;America\/Santo_Domingo&quot;,&quot;America\/Sao_Paulo&quot;:&quot;America\/Sao_Paulo&quot;,&quot;America\/Scoresbysund&quot;:&quot;America\/Scoresbysund&quot;,&quot;America\/Sitka&quot;:&quot;America\/Sitka&quot;,&quot;America\/St_Barthelemy&quot;:&quot;America\/St_Barthelemy&quot;,&quot;America\/St_Johns&quot;:&quot;America\/St_Johns&quot;,&quot;America\/St_Kitts&quot;:&quot;America\/St_Kitts&quot;,&quot;America\/St_Lucia&quot;:&quot;America\/St_Lucia&quot;,&quot;America\/St_Thomas&quot;:&quot;America\/St_Thomas&quot;,&quot;America\/St_Vincent&quot;:&quot;America\/St_Vincent&quot;,&quot;America\/Swift_Current&quot;:&quot;America\/Swift_Current&quot;,&quot;America\/Tegucigalpa&quot;:&quot;America\/Tegucigalpa&quot;,&quot;America\/Thule&quot;:&quot;America\/Thule&quot;,&quot;America\/Thunder_Bay&quot;:&quot;America\/Thunder_Bay&quot;,&quot;America\/Tijuana&quot;:&quot;America\/Tijuana&quot;,&quot;America\/Toronto&quot;:&quot;America\/Toronto&quot;,&quot;America\/Tortola&quot;:&quot;America\/Tortola&quot;,&quot;America\/Vancouver&quot;:&quot;America\/Vancouver&quot;,&quot;America\/Whitehorse&quot;:&quot;America\/Whitehorse&quot;,&quot;America\/Winnipeg&quot;:&quot;America\/Winnipeg&quot;,&quot;America\/Yakutat&quot;:&quot;America\/Yakutat&quot;,&quot;America\/Yellowknife&quot;:&quot;America\/Yellowknife&quot;,&quot;Antarctica\/Casey&quot;:&quot;Antarctica\/Casey&quot;,&quot;Antarctica\/Davis&quot;:&quot;Antarctica\/Davis&quot;,&quot;Antarctica\/DumontDUrville&quot;:&quot;Antarctica\/DumontDUrville&quot;,&quot;Antarctica\/Macquarie&quot;:&quot;Antarctica\/Macquarie&quot;,&quot;Antarctica\/Mawson&quot;:&quot;Antarctica\/Mawson&quot;,&quot;Antarctica\/McMurdo&quot;:&quot;Antarctica\/McMurdo&quot;,&quot;Antarctica\/Palmer&quot;:&quot;Antarctica\/Palmer&quot;,&quot;Antarctica\/Rothera&quot;:&quot;Antarctica\/Rothera&quot;,&quot;Antarctica\/Syowa&quot;:&quot;Antarctica\/Syowa&quot;,&quot;Antarctica\/Troll&quot;:&quot;Antarctica\/Troll&quot;,&quot;Antarctica\/Vostok&quot;:&quot;Antarctica\/Vostok&quot;,&quot;Arctic\/Longyearbyen&quot;:&quot;Arctic\/Longyearbyen&quot;,&quot;Asia\/Aden&quot;:&quot;Asia\/Aden&quot;,&quot;Asia\/Almaty&quot;:&quot;Asia\/Almaty&quot;,&quot;Asia\/Amman&quot;:&quot;Asia\/Amman&quot;,&quot;Asia\/Anadyr&quot;:&quot;Asia\/Anadyr&quot;,&quot;Asia\/Aqtau&quot;:&quot;Asia\/Aqtau&quot;,&quot;Asia\/Aqtobe&quot;:&quot;Asia\/Aqtobe&quot;,&quot;Asia\/Ashgabat&quot;:&quot;Asia\/Ashgabat&quot;,&quot;Asia\/Atyrau&quot;:&quot;Asia\/Atyrau&quot;,&quot;Asia\/Baghdad&quot;:&quot;Asia\/Baghdad&quot;,&quot;Asia\/Bahrain&quot;:&quot;Asia\/Bahrain&quot;,&quot;Asia\/Baku&quot;:&quot;Asia\/Baku&quot;,&quot;Asia\/Bangkok&quot;:&quot;Asia\/Bangkok&quot;,&quot;Asia\/Barnaul&quot;:&quot;Asia\/Barnaul&quot;,&quot;Asia\/Beirut&quot;:&quot;Asia\/Beirut&quot;,&quot;Asia\/Bishkek&quot;:&quot;Asia\/Bishkek&quot;,&quot;Asia\/Brunei&quot;:&quot;Asia\/Brunei&quot;,&quot;Asia\/Chita&quot;:&quot;Asia\/Chita&quot;,&quot;Asia\/Choibalsan&quot;:&quot;Asia\/Choibalsan&quot;,&quot;Asia\/Colombo&quot;:&quot;Asia\/Colombo&quot;,&quot;Asia\/Damascus&quot;:&quot;Asia\/Damascus&quot;,&quot;Asia\/Dhaka&quot;:&quot;Asia\/Dhaka&quot;,&quot;Asia\/Dili&quot;:&quot;Asia\/Dili&quot;,&quot;Asia\/Dubai&quot;:&quot;Asia\/Dubai&quot;,&quot;Asia\/Dushanbe&quot;:&quot;Asia\/Dushanbe&quot;,&quot;Asia\/Famagusta&quot;:&quot;Asia\/Famagusta&quot;,&quot;Asia\/Gaza&quot;:&quot;Asia\/Gaza&quot;,&quot;Asia\/Hebron&quot;:&quot;Asia\/Hebron&quot;,&quot;Asia\/Ho_Chi_Minh&quot;:&quot;Asia\/Ho_Chi_Minh&quot;,&quot;Asia\/Hong_Kong&quot;:&quot;Asia\/Hong_Kong&quot;,&quot;Asia\/Hovd&quot;:&quot;Asia\/Hovd&quot;,&quot;Asia\/Irkutsk&quot;:&quot;Asia\/Irkutsk&quot;,&quot;Asia\/Jakarta&quot;:&quot;Asia\/Jakarta&quot;,&quot;Asia\/Jayapura&quot;:&quot;Asia\/Jayapura&quot;,&quot;Asia\/Jerusalem&quot;:&quot;Asia\/Jerusalem&quot;,&quot;Asia\/Kabul&quot;:&quot;Asia\/Kabul&quot;,&quot;Asia\/Kamchatka&quot;:&quot;Asia\/Kamchatka&quot;,&quot;Asia\/Karachi&quot;:&quot;Asia\/Karachi&quot;,&quot;Asia\/Kathmandu&quot;:&quot;Asia\/Kathmandu&quot;,&quot;Asia\/Khandyga&quot;:&quot;Asia\/Khandyga&quot;,&quot;Asia\/Kolkata&quot;:&quot;Asia\/Kolkata&quot;,&quot;Asia\/Krasnoyarsk&quot;:&quot;Asia\/Krasnoyarsk&quot;,&quot;Asia\/Kuala_Lumpur&quot;:&quot;Asia\/Kuala_Lumpur&quot;,&quot;Asia\/Kuching&quot;:&quot;Asia\/Kuching&quot;,&quot;Asia\/Kuwait&quot;:&quot;Asia\/Kuwait&quot;,&quot;Asia\/Macau&quot;:&quot;Asia\/Macau&quot;,&quot;Asia\/Magadan&quot;:&quot;Asia\/Magadan&quot;,&quot;Asia\/Makassar&quot;:&quot;Asia\/Makassar&quot;,&quot;Asia\/Manila&quot;:&quot;Asia\/Manila&quot;,&quot;Asia\/Muscat&quot;:&quot;Asia\/Muscat&quot;,&quot;Asia\/Nicosia&quot;:&quot;Asia\/Nicosia&quot;,&quot;Asia\/Novokuznetsk&quot;:&quot;Asia\/Novokuznetsk&quot;,&quot;Asia\/Novosibirsk&quot;:&quot;Asia\/Novosibirsk&quot;,&quot;Asia\/Omsk&quot;:&quot;Asia\/Omsk&quot;,&quot;Asia\/Oral&quot;:&quot;Asia\/Oral&quot;,&quot;Asia\/Phnom_Penh&quot;:&quot;Asia\/Phnom_Penh&quot;,&quot;Asia\/Pontianak&quot;:&quot;Asia\/Pontianak&quot;,&quot;Asia\/Pyongyang&quot;:&quot;Asia\/Pyongyang&quot;,&quot;Asia\/Qatar&quot;:&quot;Asia\/Qatar&quot;,&quot;Asia\/Qostanay&quot;:&quot;Asia\/Qostanay&quot;,&quot;Asia\/Qyzylorda&quot;:&quot;Asia\/Qyzylorda&quot;,&quot;Asia\/Riyadh&quot;:&quot;Asia\/Riyadh&quot;,&quot;Asia\/Sakhalin&quot;:&quot;Asia\/Sakhalin&quot;,&quot;Asia\/Samarkand&quot;:&quot;Asia\/Samarkand&quot;,&quot;Asia\/Seoul&quot;:&quot;Asia\/Seoul&quot;,&quot;Asia\/Shanghai&quot;:&quot;Asia\/Shanghai&quot;,&quot;Asia\/Singapore&quot;:&quot;Asia\/Singapore&quot;,&quot;Asia\/Srednekolymsk&quot;:&quot;Asia\/Srednekolymsk&quot;,&quot;Asia\/Taipei&quot;:&quot;Asia\/Taipei&quot;,&quot;Asia\/Tashkent&quot;:&quot;Asia\/Tashkent&quot;,&quot;Asia\/Tbilisi&quot;:&quot;Asia\/Tbilisi&quot;,&quot;Asia\/Tehran&quot;:&quot;Asia\/Tehran&quot;,&quot;Asia\/Thimphu&quot;:&quot;Asia\/Thimphu&quot;,&quot;Asia\/Tokyo&quot;:&quot;Asia\/Tokyo&quot;,&quot;Asia\/Tomsk&quot;:&quot;Asia\/Tomsk&quot;,&quot;Asia\/Ulaanbaatar&quot;:&quot;Asia\/Ulaanbaatar&quot;,&quot;Asia\/Urumqi&quot;:&quot;Asia\/Urumqi&quot;,&quot;Asia\/Ust-Nera&quot;:&quot;Asia\/Ust-Nera&quot;,&quot;Asia\/Vientiane&quot;:&quot;Asia\/Vientiane&quot;,&quot;Asia\/Vladivostok&quot;:&quot;Asia\/Vladivostok&quot;,&quot;Asia\/Yakutsk&quot;:&quot;Asia\/Yakutsk&quot;,&quot;Asia\/Yangon&quot;:&quot;Asia\/Yangon&quot;,&quot;Asia\/Yekaterinburg&quot;:&quot;Asia\/Yekaterinburg&quot;,&quot;Asia\/Yerevan&quot;:&quot;Asia\/Yerevan&quot;,&quot;Atlantic\/Azores&quot;:&quot;Atlantic\/Azores&quot;,&quot;Atlantic\/Bermuda&quot;:&quot;Atlantic\/Bermuda&quot;,&quot;Atlantic\/Canary&quot;:&quot;Atlantic\/Canary&quot;,&quot;Atlantic\/Cape_Verde&quot;:&quot;Atlantic\/Cape_Verde&quot;,&quot;Atlantic\/Faroe&quot;:&quot;Atlantic\/Faroe&quot;,&quot;Atlantic\/Madeira&quot;:&quot;Atlantic\/Madeira&quot;,&quot;Atlantic\/Reykjavik&quot;:&quot;Atlantic\/Reykjavik&quot;,&quot;Atlantic\/South_Georgia&quot;:&quot;Atlantic\/South_Georgia&quot;,&quot;Atlantic\/St_Helena&quot;:&quot;Atlantic\/St_Helena&quot;,&quot;Atlantic\/Stanley&quot;:&quot;Atlantic\/Stanley&quot;,&quot;Australia\/Adelaide&quot;:&quot;Australia\/Adelaide&quot;,&quot;Australia\/Brisbane&quot;:&quot;Australia\/Brisbane&quot;,&quot;Australia\/Broken_Hill&quot;:&quot;Australia\/Broken_Hill&quot;,&quot;Australia\/Currie&quot;:&quot;Australia\/Currie&quot;,&quot;Australia\/Darwin&quot;:&quot;Australia\/Darwin&quot;,&quot;Australia\/Eucla&quot;:&quot;Australia\/Eucla&quot;,&quot;Australia\/Hobart&quot;:&quot;Australia\/Hobart&quot;,&quot;Australia\/Lindeman&quot;:&quot;Australia\/Lindeman&quot;,&quot;Australia\/Lord_Howe&quot;:&quot;Australia\/Lord_Howe&quot;,&quot;Australia\/Melbourne&quot;:&quot;Australia\/Melbourne&quot;,&quot;Australia\/Perth&quot;:&quot;Australia\/Perth&quot;,&quot;Australia\/Sydney&quot;:&quot;Australia\/Sydney&quot;,&quot;Europe\/Amsterdam&quot;:&quot;Europe\/Amsterdam&quot;,&quot;Europe\/Andorra&quot;:&quot;Europe\/Andorra&quot;,&quot;Europe\/Astrakhan&quot;:&quot;Europe\/Astrakhan&quot;,&quot;Europe\/Athens&quot;:&quot;Europe\/Athens&quot;,&quot;Europe\/Belgrade&quot;:&quot;Europe\/Belgrade&quot;,&quot;Europe\/Berlin&quot;:&quot;Europe\/Berlin&quot;,&quot;Europe\/Bratislava&quot;:&quot;Europe\/Bratislava&quot;,&quot;Europe\/Brussels&quot;:&quot;Europe\/Brussels&quot;,&quot;Europe\/Bucharest&quot;:&quot;Europe\/Bucharest&quot;,&quot;Europe\/Budapest&quot;:&quot;Europe\/Budapest&quot;,&quot;Europe\/Busingen&quot;:&quot;Europe\/Busingen&quot;,&quot;Europe\/Chisinau&quot;:&quot;Europe\/Chisinau&quot;,&quot;Europe\/Copenhagen&quot;:&quot;Europe\/Copenhagen&quot;,&quot;Europe\/Dublin&quot;:&quot;Europe\/Dublin&quot;,&quot;Europe\/Gibraltar&quot;:&quot;Europe\/Gibraltar&quot;,&quot;Europe\/Guernsey&quot;:&quot;Europe\/Guernsey&quot;,&quot;Europe\/Helsinki&quot;:&quot;Europe\/Helsinki&quot;,&quot;Europe\/Isle_of_Man&quot;:&quot;Europe\/Isle_of_Man&quot;,&quot;Europe\/Istanbul&quot;:&quot;Europe\/Istanbul&quot;,&quot;Europe\/Jersey&quot;:&quot;Europe\/Jersey&quot;,&quot;Europe\/Kaliningrad&quot;:&quot;Europe\/Kaliningrad&quot;,&quot;Europe\/Kiev&quot;:&quot;Europe\/Kiev&quot;,&quot;Europe\/Kirov&quot;:&quot;Europe\/Kirov&quot;,&quot;Europe\/Lisbon&quot;:&quot;Europe\/Lisbon&quot;,&quot;Europe\/Ljubljana&quot;:&quot;Europe\/Ljubljana&quot;,&quot;Europe\/London&quot;:&quot;Europe\/London&quot;,&quot;Europe\/Luxembourg&quot;:&quot;Europe\/Luxembourg&quot;,&quot;Europe\/Madrid&quot;:&quot;Europe\/Madrid&quot;,&quot;Europe\/Malta&quot;:&quot;Europe\/Malta&quot;,&quot;Europe\/Mariehamn&quot;:&quot;Europe\/Mariehamn&quot;,&quot;Europe\/Minsk&quot;:&quot;Europe\/Minsk&quot;,&quot;Europe\/Monaco&quot;:&quot;Europe\/Monaco&quot;,&quot;Europe\/Moscow&quot;:&quot;Europe\/Moscow&quot;,&quot;Europe\/Oslo&quot;:&quot;Europe\/Oslo&quot;,&quot;Europe\/Paris&quot;:&quot;Europe\/Paris&quot;,&quot;Europe\/Podgorica&quot;:&quot;Europe\/Podgorica&quot;,&quot;Europe\/Prague&quot;:&quot;Europe\/Prague&quot;,&quot;Europe\/Riga&quot;:&quot;Europe\/Riga&quot;,&quot;Europe\/Rome&quot;:&quot;Europe\/Rome&quot;,&quot;Europe\/Samara&quot;:&quot;Europe\/Samara&quot;,&quot;Europe\/San_Marino&quot;:&quot;Europe\/San_Marino&quot;,&quot;Europe\/Sarajevo&quot;:&quot;Europe\/Sarajevo&quot;,&quot;Europe\/Saratov&quot;:&quot;Europe\/Saratov&quot;,&quot;Europe\/Simferopol&quot;:&quot;Europe\/Simferopol&quot;,&quot;Europe\/Skopje&quot;:&quot;Europe\/Skopje&quot;,&quot;Europe\/Sofia&quot;:&quot;Europe\/Sofia&quot;,&quot;Europe\/Stockholm&quot;:&quot;Europe\/Stockholm&quot;,&quot;Europe\/Tallinn&quot;:&quot;Europe\/Tallinn&quot;,&quot;Europe\/Tirane&quot;:&quot;Europe\/Tirane&quot;,&quot;Europe\/Ulyanovsk&quot;:&quot;Europe\/Ulyanovsk&quot;,&quot;Europe\/Uzhgorod&quot;:&quot;Europe\/Uzhgorod&quot;,&quot;Europe\/Vaduz&quot;:&quot;Europe\/Vaduz&quot;,&quot;Europe\/Vatican&quot;:&quot;Europe\/Vatican&quot;,&quot;Europe\/Vienna&quot;:&quot;Europe\/Vienna&quot;,&quot;Europe\/Vilnius&quot;:&quot;Europe\/Vilnius&quot;,&quot;Europe\/Volgograd&quot;:&quot;Europe\/Volgograd&quot;,&quot;Europe\/Warsaw&quot;:&quot;Europe\/Warsaw&quot;,&quot;Europe\/Zagreb&quot;:&quot;Europe\/Zagreb&quot;,&quot;Europe\/Zaporozhye&quot;:&quot;Europe\/Zaporozhye&quot;,&quot;Europe\/Zurich&quot;:&quot;Europe\/Zurich&quot;,&quot;Indian\/Antananarivo&quot;:&quot;Indian\/Antananarivo&quot;,&quot;Indian\/Chagos&quot;:&quot;Indian\/Chagos&quot;,&quot;Indian\/Christmas&quot;:&quot;Indian\/Christmas&quot;,&quot;Indian\/Cocos&quot;:&quot;Indian\/Cocos&quot;,&quot;Indian\/Comoro&quot;:&quot;Indian\/Comoro&quot;,&quot;Indian\/Kerguelen&quot;:&quot;Indian\/Kerguelen&quot;,&quot;Indian\/Mahe&quot;:&quot;Indian\/Mahe&quot;,&quot;Indian\/Maldives&quot;:&quot;Indian\/Maldives&quot;,&quot;Indian\/Mauritius&quot;:&quot;Indian\/Mauritius&quot;,&quot;Indian\/Mayotte&quot;:&quot;Indian\/Mayotte&quot;,&quot;Indian\/Reunion&quot;:&quot;Indian\/Reunion&quot;,&quot;Pacific\/Apia&quot;:&quot;Pacific\/Apia&quot;,&quot;Pacific\/Auckland&quot;:&quot;Pacific\/Auckland&quot;,&quot;Pacific\/Bougainville&quot;:&quot;Pacific\/Bougainville&quot;,&quot;Pacific\/Chatham&quot;:&quot;Pacific\/Chatham&quot;,&quot;Pacific\/Chuuk&quot;:&quot;Pacific\/Chuuk&quot;,&quot;Pacific\/Easter&quot;:&quot;Pacific\/Easter&quot;,&quot;Pacific\/Efate&quot;:&quot;Pacific\/Efate&quot;,&quot;Pacific\/Enderbury&quot;:&quot;Pacific\/Enderbury&quot;,&quot;Pacific\/Fakaofo&quot;:&quot;Pacific\/Fakaofo&quot;,&quot;Pacific\/Fiji&quot;:&quot;Pacific\/Fiji&quot;,&quot;Pacific\/Funafuti&quot;:&quot;Pacific\/Funafuti&quot;,&quot;Pacific\/Galapagos&quot;:&quot;Pacific\/Galapagos&quot;,&quot;Pacific\/Gambier&quot;:&quot;Pacific\/Gambier&quot;,&quot;Pacific\/Guadalcanal&quot;:&quot;Pacific\/Guadalcanal&quot;,&quot;Pacific\/Guam&quot;:&quot;Pacific\/Guam&quot;,&quot;Pacific\/Honolulu&quot;:&quot;Pacific\/Honolulu&quot;,&quot;Pacific\/Kiritimati&quot;:&quot;Pacific\/Kiritimati&quot;,&quot;Pacific\/Kosrae&quot;:&quot;Pacific\/Kosrae&quot;,&quot;Pacific\/Kwajalein&quot;:&quot;Pacific\/Kwajalein&quot;,&quot;Pacific\/Majuro&quot;:&quot;Pacific\/Majuro&quot;,&quot;Pacific\/Marquesas&quot;:&quot;Pacific\/Marquesas&quot;,&quot;Pacific\/Midway&quot;:&quot;Pacific\/Midway&quot;,&quot;Pacific\/Nauru&quot;:&quot;Pacific\/Nauru&quot;,&quot;Pacific\/Niue&quot;:&quot;Pacific\/Niue&quot;,&quot;Pacific\/Norfolk&quot;:&quot;Pacific\/Norfolk&quot;,&quot;Pacific\/Noumea&quot;:&quot;Pacific\/Noumea&quot;,&quot;Pacific\/Pago_Pago&quot;:&quot;Pacific\/Pago_Pago&quot;,&quot;Pacific\/Palau&quot;:&quot;Pacific\/Palau&quot;,&quot;Pacific\/Pitcairn&quot;:&quot;Pacific\/Pitcairn&quot;,&quot;Pacific\/Pohnpei&quot;:&quot;Pacific\/Pohnpei&quot;,&quot;Pacific\/Port_Moresby&quot;:&quot;Pacific\/Port_Moresby&quot;,&quot;Pacific\/Rarotonga&quot;:&quot;Pacific\/Rarotonga&quot;,&quot;Pacific\/Saipan&quot;:&quot;Pacific\/Saipan&quot;,&quot;Pacific\/Tahiti&quot;:&quot;Pacific\/Tahiti&quot;,&quot;Pacific\/Tarawa&quot;:&quot;Pacific\/Tarawa&quot;,&quot;Pacific\/Tongatapu&quot;:&quot;Pacific\/Tongatapu&quot;,&quot;Pacific\/Wake&quot;:&quot;Pacific\/Wake&quot;,&quot;Pacific\/Wallis&quot;:&quot;Pacific\/Wallis&quot;,&quot;UTC&quot;:&quot;UTC&quot;}"
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting->timezone}}"
                                               data-value="{{ $setting->timezone }}" data-original-title=""
                                               title="@lang('Timezone')">{{ $setting->timezone }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Home About Title')</td>
                                        <td colspan="3">
                                            <a href="javascript:void(0)"
                                               class="textAreaW fied-required editable editable-click"
                                               data-name="home_atitle"
                                               data-type="text" data-pk="2" data-source=""
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting->home_atitle }}"
                                               data-value="{{ $setting->home_atitle }}" data-original-title=""
                                               title="@lang('Home About Title')">{{ $setting->home_atitle }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('About Us')</td>
                                        <td colspan="3">
                                            <a href="javascript:void(0)"
                                               class="textAreaW fied-required editable editable-click"
                                               data-name="about"
                                               data-type="textarea" data-pk="1" data-source=""
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting['school']->about }}"
                                               data-value="{{ $setting['school']->about }}" data-original-title=""
                                               title="@lang('About Us')">{{ \Illuminate\Support\Str::limit($setting['school']->about,80) }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('About Us Photo')</td>
                                        <td>
                                            @if(!empty($setting->about_pic))
                                                <img src="{{asset('img/400.png')}}"
                                                     data-src="{{url($setting->about_pic)}}" class="img-thumbnail"
                                                     id="my-profile" alt="About" width="100%">
                                                <div class="btn-group removeUpImage pagination"
                                                     onclick="img_confirm_delete('settings','{{$setting->id}}','about_pic','your about us picture')">
                                                    <span class="btn btn-info btn-sm">@lang('Remove')</span>
                                                    <span class="btn btn-danger btn-sm">&times;</span>
                                                </div>
                                            @else
                                                <div class="image-upload">
                                                    <label for="about-upload">
                                                        <img src="{{asset('img/400.png')}}"
                                                             id="preview_about" class="img-responsive">
                                                    </label>
                                                    <input type="file" value="" class="file-upload standard_width"
                                                           id="about-upload" accept="image/*">
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Our Mission')</td>
                                        <td colspan="3">
                                            <a href="javascript:void(0)"
                                               class="textAreaW fied-required editable editable-click"
                                               data-name="mission"
                                               data-type="textarea" data-pk="1" data-source=""
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting['school']->mission }}"
                                               data-value="{{ $setting['school']->mission }}" data-original-title=""
                                               title="@lang('Our Mission')">{{ \Illuminate\Support\Str::limit($setting['school']->mission,50) }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Our Vision')</td>
                                        <td colspan="3">
                                            <a href="javascript:void(0)"
                                               class="textAreaW fied-required editable editable-click"
                                               data-name="vision"
                                               data-type="textarea" data-pk="1" data-source=""
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting['school']->vision }}"
                                               data-value="{{ $setting['school']->vision }}" data-original-title=""
                                               title="@lang('Our Vision')">{{ \Illuminate\Support\Str::limit($setting['school']->vision,50) }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Map')</td>
                                        <td colspan="3">
                                            <a href="javascript:void(0)"
                                               class="textAreaW fied-required editable editable-click"
                                               data-name="site_map"
                                               data-type="textarea" data-pk="2" data-source=""
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting->site_map }}"
                                               data-value="{{ $setting->site_map }}" data-original-title=""
                                               title="@lang('Site Map')">{{ \Illuminate\Support\Str::limit($setting->site_map,50) }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Slider and Notice as well')</td>
                                        <td>
                                            <a href="javascript:void(0)" class="fied-required editable editable-click"
                                               data-name="slider_notice"
                                               data-type="select" data-pk="2"
                                               data-source="{{ json_encode(['1'=>trans('Full width Slider'),'2'=>trans('Left Slider and Right Notice')]) }}"
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting->slider_notice}}"
                                               data-value="{{ $setting->slider_notice }}" data-original-title=""
                                               title="@lang('Slider and Notice as well')">{{ $setting->slider_notice == 1 ? trans('Full width Slider') : trans('Left Slider and Right Notice') }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Breaking News')</td>
                                        <td>
                                            <a href="javascript:void(0)" class="fied-required editable editable-click"
                                               data-name="breaking_news"
                                               data-type="select" data-pk="2"
                                               data-source="{{ json_encode(['1'=>'Yes','0'=>'No']) }}"
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting->breaking_news}}"
                                               data-value="{{ $setting->breaking_news }}" data-original-title=""
                                               title="@lang('Breaking News')">{{ $setting->breaking_news == 1 ? 'Yes' : 'No' }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Breaking News Position')</td>
                                        <td>
                                            <a href="javascript:void(0)" class="fied-required editable editable-click"
                                               data-name="breaking_news_position"
                                               data-type="select" data-pk="2"
                                               data-source="{{ json_encode(['1'=>'Site Top','2'=>'Top bar Bottom','3'=>'Slider Bottom']) }}"
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting->breaking_news_position}}"
                                               data-value="{{ $setting->breaking_news_position }}"
                                               data-original-title=""
                                               title="@lang('Breaking News')">{{ $setting->breaking_news_position == 1 ? 'Site Top' : ($setting->breaking_news_position == 2 ? 'Top bar Bottom' : 'Slider Bottom') }}</a>
                                        </td>
                                    </tr>
                                    {{--            <tr>
                                        <td>@lang('Breaking News Background')</td>
                                        <td>
                                            <a href="javascript:void(0)" class="fied-required editable editable-click"
                                               data-name="breaking_news_bg"
                                               data-type="select" data-pk="2"
                                               data-source="{{ json_encode(['1'=>'Site Top','2'=>'Top bar Bottom','3'=>'Slider Bottom']) }}"
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting->breaking_news_bg}}"
                                               data-value="{{ $setting->breaking_news_bg }}" data-original-title=""
                                               title="@lang('Breaking News Background')">{{ $setting->breaking_news_bg}}</a>
                                        </td>
                                    </tr>--}}
                                    <tr>
                                        <td>@lang('Breaking News Background')</td>
                                        <td>
                                            <input class="form-control pull-left color-picker" type="text" data-id="1"
                                                   value="{{ $setting->breaking_news_bg }}" id="bg_bn_color_1"
                                                   style="width: 40%;border: none;border-bottom: 1px dashed;"/>
                                            <div class="editable-buttons pull-left color-edit-btn d-none color_btn_1">
                                                <button type="button"
                                                        class="btn btn-primary btn-sm editable-submit extra-filed-add"
                                                        data-id="1" data-pk="2" data-name="breaking_news_bg"><i
                                                            class="glyphicon glyphicon-ok"></i></button>
                                                <button type="button"
                                                        class="btn btn-default btn-sm editable-cancel hide-submit-btn"
                                                        data-id="1" data-value="{{ $setting->breaking_news_bg }}">
                                                    <i class="glyphicon glyphicon-remove"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Breaking News Text Color')</td>
                                        <td>
                                            <input class="form-control pull-left color-picker" type="text" data-id="2"
                                                   value="{{ $setting->breaking_news_tc }}" id="bg_bn_color_2"
                                                   style="width: 40%;border: none;border-bottom: 1px dashed;"/>
                                            <div class="editable-buttons pull-left color-edit-btn d-none color_btn_2">
                                                <button type="button"
                                                        class="btn btn-primary btn-sm editable-submit extra-filed-add"
                                                        data-id="2" data-pk="2" data-name="breaking_news_tc"><i
                                                            class="glyphicon glyphicon-ok"></i></button>
                                                <button type="button"
                                                        class="btn btn-default btn-sm editable-cancel hide-submit-btn"
                                                        data-id="2" data-value="{{ $setting->breaking_news_tc }}">
                                                    <i class="glyphicon glyphicon-remove"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Theme Background')</td>
                                        <td>
                                            <input class="form-control pull-left color-picker" type="text" data-id="3"
                                                   value="{{ $setting->theme_bg }}" id="bg_bn_color_3"
                                                   style="width: 40%;border: none;border-bottom: 1px dashed;"/>
                                            <div class="editable-buttons pull-left color-edit-btn d-none color_btn_3">
                                                <button type="button"
                                                        class="btn btn-primary btn-sm editable-submit extra-filed-add"
                                                        data-id="3" data-pk="2" data-name="theme_bg"><i
                                                            class="glyphicon glyphicon-ok"></i></button>
                                                <button type="button"
                                                        class="btn btn-default btn-sm editable-cancel hide-submit-btn"
                                                        data-id="3" data-value="{{ $setting->theme_bg }}">
                                                    <i class="glyphicon glyphicon-remove"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Theme Text Color')</td>
                                        <td>
                                            <input class="form-control pull-left color-picker" type="text" data-id="4"
                                                   value="{{ $setting->theme_color }}" id="bg_bn_color_4"
                                                   style="width: 40%;border: none;border-bottom: 1px dashed;"/>
                                            <div class="editable-buttons pull-left color-edit-btn d-none color_btn_4">
                                                <button type="button"
                                                        class="btn btn-primary btn-sm editable-submit extra-filed-add"
                                                        data-id="4" data-pk="2" data-name="theme_color"><i
                                                            class="glyphicon glyphicon-ok"></i></button>
                                                <button type="button"
                                                        class="btn btn-default btn-sm editable-cancel hide-submit-btn"
                                                        data-id="4" data-value="{{ $setting->theme_color }}">
                                                    <i class="glyphicon glyphicon-remove"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Menu Background')</td>
                                        <td>
                                            <input class="form-control pull-left color-picker" type="text" data-id="5"
                                                   value="{{ $setting->menu_bg }}" id="bg_bn_color_5"
                                                   style="width: 40%;border: none;border-bottom: 1px dashed;"/>
                                            <div class="editable-buttons pull-left color-edit-btn d-none color_btn_5">
                                                <button type="button"
                                                        class="btn btn-primary btn-sm editable-submit extra-filed-add"
                                                        data-id="5" data-pk="2" data-name="menu_bg"><i
                                                            class="glyphicon glyphicon-ok"></i></button>
                                                <button type="button"
                                                        class="btn btn-default btn-sm editable-cancel hide-submit-btn"
                                                        data-id="5" data-value="{{ $setting->menu_bg }}">
                                                    <i class="glyphicon glyphicon-remove"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Menu Text Color')</td>
                                        <td>
                                            <input class="form-control pull-left color-picker" type="text" data-id="6"
                                                   value="{{ $setting->menu_color }}" id="bg_bn_color_6"
                                                   style="width: 40%;border: none;border-bottom: 1px dashed;"/>
                                            <div class="editable-buttons pull-left color-edit-btn d-none color_btn_6">
                                                <button type="button"
                                                        class="btn btn-primary btn-sm editable-submit extra-filed-add"
                                                        data-id="6" data-pk="2" data-name="menu_color"><i
                                                            class="glyphicon glyphicon-ok"></i></button>
                                                <button type="button"
                                                        class="btn btn-default btn-sm editable-cancel hide-submit-btn"
                                                        data-id="6" data-value="{{ $setting->menu_color }}">
                                                    <i class="glyphicon glyphicon-remove"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Submenu Background')</td>
                                        <td>
                                            <input class="form-control pull-left color-picker" type="text" data-id="7"
                                                   value="{{ $setting->submenu_bg }}" id="bg_bn_color_7"
                                                   style="width: 40%;border: none;border-bottom: 1px dashed;"/>
                                            <div class="editable-buttons pull-left color-edit-btn d-none color_btn_7">
                                                <button type="button"
                                                        class="btn btn-primary btn-sm editable-submit extra-filed-add"
                                                        data-id="7" data-pk="2" data-name="submenu_bg"><i
                                                            class="glyphicon glyphicon-ok"></i></button>
                                                <button type="button"
                                                        class="btn btn-default btn-sm editable-cancel hide-submit-btn"
                                                        data-id="7" data-value="{{ $setting->submenu_bg }}">
                                                    <i class="glyphicon glyphicon-remove"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Submenu Text Color')</td>
                                        <td>
                                            <input class="form-control pull-left color-picker" type="text" data-id="8"
                                                   value="{{ $setting->submenu_color }}" id="bg_bn_color_8"
                                                   style="width: 40%;border: none;border-bottom: 1px dashed;"/>
                                            <div class="editable-buttons pull-left color-edit-btn d-none color_btn_8">
                                                <button type="button"
                                                        class="btn btn-primary btn-sm editable-submit extra-filed-add"
                                                        data-id="8" data-pk="2" data-name="submenu_color"><i
                                                            class="glyphicon glyphicon-ok"></i></button>
                                                <button type="button"
                                                        class="btn btn-default btn-sm editable-cancel hide-submit-btn"
                                                        data-id="8" data-value="{{ $setting->submenu_color }}">
                                                    <i class="glyphicon glyphicon-remove"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Head Of Institute Signature')</td>
                                        <td>
                                            @if(!empty($setting->head_signature))
                                                <img src="{{asset('img/400.png')}}"
                                                     data-src="{{url($setting->head_signature)}}" class="img-thumbnail"
                                                     id="my-profile" alt="About" width="100%">
                                                <div class="btn-group removeUpImage pagination"
                                                     onclick="img_confirm_delete('settings','{{$setting->id}}','head_signature','your Head Of Institute Signature')">
                                                    <span class="btn btn-info btn-sm">@lang('Remove')</span>
                                                    <span class="btn btn-danger btn-sm">&times;</span>
                                                </div>
                                            @else
                                                <div class="image-upload">
                                                    <label for="HeadSign-upload">
                                                        <img src="{{asset('img/400.png')}}"
                                                             id="preview_HeadSign" class="img-responsive">
                                                    </label>
                                                    <input type="file" value="" class="file-upload standard_width"
                                                           id="HeadSign-upload" accept="image/*">
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 pr-0 ex-w-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">@lang('Admission Section')</div>
                            <div class="panel-body">
                                <table class="table table-responsive">
                                    <tbody>
                                    <tr>
                                        <td>@lang('Admission Form')</td>
                                        <td>
                                            <a href="javascript:void(0)" class="fied-required editable editable-click"
                                               data-name="admission_form"
                                               data-type="select" data-pk="2"
                                               data-source="{{ json_encode(['1'=>'Published','0'=>'Unpublished']) }}"
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting->admission_form}}"
                                               data-value="{{ $setting->admission_form }}" data-original-title=""
                                               title="@lang('Admission Form')">{{ $setting->admission_form == 1 ? 'Published' : 'Unpublished' }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Admission Login info')</td>
                                        <td>
                                            <a href="javascript:void(0)" class="fied-required editable editable-click"
                                               data-name="admission_loginInfo"
                                               data-type="select" data-pk="2"
                                               data-source="{{ json_encode(['1'=>'Yes','0'=>'No']) }}"
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting->admission_loginInfo}}"
                                               data-value="{{ $setting->admission_loginInfo }}" data-original-title=""
                                               title="@lang('Admission Login info')">{{ $setting->admission_loginInfo == 1 ? 'Yes' : 'No' }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Admission Verify')</td>
                                        <td>
                                            <a href="javascript:void(0)" class="fied-required editable editable-click"
                                               data-name="admission_verify"
                                               data-type="select" data-pk="2"
                                               data-source="{{ json_encode(['1'=>'Yes','0'=>'No']) }}"
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting->admission_verify}}"
                                               data-value="{{ $setting->admission_verify }}" data-original-title=""
                                               title="@lang('Admission Verify')">{{ $setting->admission_verify == 1 ? 'Yes' : 'No' }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Admission Payment Status')</td>
                                        <td>
                                            <a href="javascript:void(0)" class="fied-required editable editable-click"
                                               data-name="add_payment_status"
                                               data-type="select" data-pk="2"
                                               data-source="{{ json_encode(['1'=>'With Payment Application','0'=>'Without Payment Application']) }}"
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting->add_payment_status}}"
                                               data-value="{{ $setting->add_payment_status }}" data-original-title=""
                                               title="@lang('Admission Payment Status')">{{ $setting->add_payment_status == 1 ? 'With Payment' : 'Without Payment' }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Admission Amount Charge')</td>
                                        <td>
                                            <a href="javascript:void(0)" class="fied-required editable editable-click"
                                               data-name="add_amount_charge"
                                               data-type="select" data-pk="2"
                                               data-source="{{ json_encode(['1'=>'Amount with Stripe/Sslcommerz charge','0'=>'Amount without Stripe/Sslcommerz charge']) }}"
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting->add_amount_charge}}"
                                               data-value="{{ $setting->add_amount_charge }}" data-original-title=""
                                               title="@lang('Admission Amount Charge')">{{ $setting->add_amount_charge == 1 ? 'Amount with Stripe/Sslcommerz charge' : 'Amount without Stripe/Sslcommerz charge'  }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        @php
                                            $classes = (new \App\Section())->getSection(true,false,false,'classes.class_number');
                                        @endphp
                                        <td>@lang('Admission Amount')</td>
                                        <td>
                                            @if($classes->count())
                                                <table>
                                                    <tbody>
                                                    @foreach($classes as $class)
                                                        @php
                                                            $admission_amount = $class->add_amount;
                                                           if (foqas_setting('add_amount_charge') == 1) {
                                                               //  charge create with amount
                                                                if (school('country')->code == 'BD'){
                                                                     $total = $admission_amount / (1 - 0.025);
                                                                     $amount = round($total, 2);
                                                                }else{
                                                                      $total = ($admission_amount + 0.30) / (1 - 0.029);
                                                                      $amount = round($total, 2) * 100;
                                                                      $amount = $amount / 100;
                                                                }
                                                           }else{
                                                               $amount = $admission_amount;
                                                           }
                                                        @endphp
                                                        <tr>
                                                            <td>{{$class->name}}</td>
                                                            <td>:</td>
                                                            <td>{{round($amount,2)}} {{school('country')->code == 'BD' ? 'Tk' : '$'}}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            @else
                                                <code>@lang('There is no admission '.(school('country')->code == 'BD' ? 'Class' : 'Grade').'. Please ')
                                                    <a target="_blank"
                                                       href="{{route('academic.class')}}">@lang('Create an admission '.(school('country')->code == 'BD' ? 'Class' : 'Grade'))</a></code>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Admission Form Download')</td>
                                        <td>
                                            <a href="javascript:void(0)" class="fied-required editable editable-click"
                                               data-name="admission_student"
                                               data-type="select" data-pk="2"
                                               data-source="{{ json_encode(['1'=>'Yes','0'=>'No']) }}"
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting->admission_student}}"
                                               data-value="{{ $setting->admission_student }}" data-original-title=""
                                               title="@lang('Admission Form Download')">{{ $setting->admission_student == 1 ? 'Yes' : 'No' }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Admission Exam')</td>
                                        <td>
                                            <a href="javascript:void(0)" class="fied-required editable editable-click"
                                               data-name="admission_exam"
                                               data-type="select" data-pk="2"
                                               data-source="{{ json_encode(['1'=>'Yes','0'=>'No']) }}"
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting->admission_exam}}"
                                               data-value="{{ $setting->admission_exam }}" data-original-title=""
                                               title="@lang('Admission Exam')">{{ $setting->admission_exam == 1 ? 'Yes' : 'No' }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Admission Admit Card')</td>
                                        <td>
                                            <a href="javascript:void(0)" class="fied-required editable editable-click"
                                               data-name="admit_card"
                                               data-type="select" data-pk="2"
                                               data-source="{{ json_encode(['1'=>'Yes','0'=>'No']) }}"
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting->admit_card}}"
                                               data-value="{{ $setting->admit_card }}" data-original-title=""
                                               title="@lang('Admission Admit Card Download')">{{ $setting->admit_card == 1 ? 'Yes' : 'No' }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Admission Admit Card Templete')</td>
                                        <td>
                                            <a href="javascript:void(0)" class="fied-required editable editable-click"
                                               data-name="admi_card_template"
                                               data-type="select" data-pk="2"
                                               data-source="{{ $admi_card_template }}"
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting->admi_card_template}}"
                                               data-value="{{ $setting->admi_card_template }}" data-original-title=""
                                               title="@lang('Admission Admit Card Templete')">{{ \App\TempleteDesign::getTemplateById($setting->admi_card_template) }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Admission Result')</td>
                                        <td>
                                            <a href="javascript:void(0)" class="fied-required editable editable-click"
                                               data-name="admission_result"
                                               data-type="select" data-pk="2"
                                               data-source="{{ json_encode(['1'=>'Yes','0'=>'No']) }}"
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting->admission_result}}"
                                               data-value="{{ $setting->admission_result }}" data-original-title=""
                                               title="@lang('Admission Result')">{{ $setting->admission_result == 1 ? 'Yes' : 'No' }}</a>
                                        </td>
                                    </tr>
                                    {{-- <tr>
                                           <td>@lang('Admission Total Student')</td>
                                           <td>
                                               <a href="javascript:void(0)" class="fied-required editable editable-click"
                                                  data-name="admission_student"
                                                  data-type="number" data-pk="2" data-source=""
                                                  data-url="{{ route('setting.update') }}"
                                                  data-title="{{ $setting->admission_student}}"
                                                  data-value="{{ $setting->admission_student }}" data-original-title=""
                                                  title="@lang('Admission Total Student')">{{ $setting->admission_student }}</a>
                                           </td>
                                       </tr>--}}
                                    <tr>
                                        <td>@lang('Merit List Show Marks')</td>
                                        <td>
                                            <a href="javascript:void(0)" class="fied-required editable editable-click"
                                               data-name="admission_show_mark"
                                               data-type="select" data-pk="2"
                                               data-source="{{ json_encode(['1'=>'Yes','0'=>'No']) }}"
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting->admission_show_mark}}"
                                               data-value="{{ $setting->admission_show_mark }}" data-original-title=""
                                               title="@lang('Merit List Show Marks')">{{ $setting->admission_show_mark == 1 ? 'Yes' : 'No' }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Admission Result Published Time')</td>
                                        <td>
                                            <a href="javascript:void(0)" id="datetime"
                                               class="editable editable-click"
                                               data-name="add_result_pubtime"
                                               data-type="datetime" data-pk="2" data-source=""
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting->add_result_pubtime}}"
                                               data-value="{{ $setting->add_result_pubtime }}" data-original-title=""
                                               title="@lang('Admission Result Published Time')">{{ $setting->add_result_pubtime }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('First Waiting List')</td>
                                        <td>
                                            <a href="javascript:void(0)" class="fied-required editable editable-click"
                                               data-name="waiting1_status"
                                               data-type="select" data-pk="2"
                                               data-source="{{ json_encode(['1'=>'Yes','0'=>'No']) }}"
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting->waiting1_status}}"
                                               data-value="{{ $setting->waiting1_status }}" data-original-title=""
                                               title="@lang('First Waiting List')">{{ $setting->waiting1_status == 1 ? 'Yes' : 'No' }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Second Waiting List')</td>
                                        <td>
                                            <a href="javascript:void(0)" class="fied-required editable editable-click"
                                               data-name="waiting2_status"
                                               data-type="select" data-pk="2"
                                               data-source="{{ json_encode(['1'=>'Yes','0'=>'No']) }}"
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting->waiting2_status}}"
                                               data-value="{{ $setting->waiting2_status }}" data-original-title=""
                                               title="@lang('Second Waiting List')">{{ $setting->waiting2_status == 1 ? 'Yes' : 'No' }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Third Waiting List')</td>
                                        <td>
                                            <a href="javascript:void(0)" class="fied-required editable editable-click"
                                               data-name="waiting3_status"
                                               data-type="select" data-pk="2"
                                               data-source="{{ json_encode(['1'=>'Yes','0'=>'No']) }}"
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting->waiting3_status}}"
                                               data-value="{{ $setting->waiting3_status }}" data-original-title=""
                                               title="@lang('Third Waiting List')">{{ $setting->waiting3_status == 1 ? 'Yes' : 'No' }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Admission Additional file')</td>
                                        <td>
                                            @foreach(admission_additional_file() as $key => $file_name)
                                                <label for="{{renderSlug($file_name)}}">
                                                    <input type="checkbox" id="{{renderSlug($file_name)}}"
                                                           class="admission_additional_file" value="{{$key}}"
                                                            {!! in_array($key,explode(',',$setting->admission_additional_file)) ? 'checked' : '' !!}>
                                                    {{$file_name}}
                                                </label>
                                                <br>
                                            @endforeach
                                            <div class="editable-buttons pull-left add_file-edit-btn d-none">
                                                <button type="button"
                                                        class="btn btn-primary btn-sm editable-submit additional_field"
                                                        data-pk="2" data-name="admission_additional_file"><i
                                                            class="glyphicon glyphicon-ok"></i></button>
                                                <button type="button"
                                                        class="btn btn-default btn-sm editable-cancel hide_additional_field">
                                                    <i class="glyphicon glyphicon-remove"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-3 pr-0 ex-w-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">@lang('Appearance')</div>
                            <div class="panel-body">
                                <table class="table table-responsive schoolLogoIcon">
                                    <tbody>
                                    <tr>
                                        <td>
                                            <label class="cursorP radio-inline"
                                                   for="standard_logo"> @lang('Standard Logo')
                                                <input {{$setting->logo_type == 2 ? "checked" : ''}} type="radio"
                                                       value="2"
                                                       name="logo_type" id="standard_logo"
                                                       class="logoForType custom-radio">
                                            </label>
                                        </td>
                                        <td>
                                            @if(\Auth::user()->role == 'admin')
                                                @if(!empty($setting->standard))
                                                    <img src="{{asset('img/standard.png')}}"
                                                         data-src="{{url($setting->standard)}}" class="img-thumbnail"
                                                         id="my-profile" alt="Standard" width="100%">
                                                    <div class="btn-group removeUpImage pagination"
                                                         onclick="img_confirm_delete('settings','{{$setting->id}}','standard','your Standard Logo')">
                                                        <span class="btn btn-info btn-sm">@lang('Remove')</span>
                                                        <span class="btn btn-danger btn-sm">&times;</span>
                                                    </div>
                                                @else
                                                    <div class="image-upload">
                                                        <label for="standard-upload">
                                                            <img src="{{asset('img/standard.png')}}"
                                                                 id="preview_standard" class="img-responsive">
                                                        </label>
                                                        <input type="file" value="" class="file-upload standard_width"
                                                               id="standard-upload" accept="image/*">
                                                    </div>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="cursorP radio-inline" for="express_logo">@lang('Express Logo')
                                                <input {{$setting->logo_type == 1 ? "checked" : ''}}  type="radio"
                                                       value="1" name="logo_type" id="express_logo"
                                                       class="logoForType custom-radio">
                                            </label>
                                        </td>
                                        <td>
                                            @if(\Auth::user()->role == 'admin')
                                                @if(!empty($setting->express))
                                                    <img src="{{asset('img/express.png')}}" style="width: 110px"
                                                         data-src="{{url($setting->express)}}" class="img-thumbnail"
                                                         id="my-profile" alt="Express">
                                                    <div class="onlyclear"></div>
                                                    <div class="btn-group removeUpImage width-100px"
                                                         onclick="img_confirm_delete('settings','{{$setting->id}}','express','your Express Logo')">
                                                        <span class="btn btn-info btn-sm">@lang('Remove')</span>
                                                        <span class="btn btn-danger btn-sm">&times;</span>
                                                    </div>
                                                @else
                                                    <div class="image-upload">
                                                        <label for="express-upload">
                                                            <img src="{{asset('img/express.png')}}" id="preview_express"
                                                                 style="width: 110px"
                                                                 class="img-responsive">
                                                        </label>
                                                        <input type="file" value="" class="file-upload standard_width"
                                                               id="express-upload" accept="image/*">
                                                    </div>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Web Icon')</td>
                                        <td>
                                            @if(\Auth::user()->role == 'admin')
                                                @if(!empty($setting->icon))
                                                    <img src="{{asset('img/icon.png')}}"
                                                         data-src="{{url($setting->icon)}}" class="img-thumbnail"
                                                         id="my-profile" alt="Icon">
                                                    <div class="onlyclear"></div>
                                                    <div class="btn-group removeUpImage width-100px"
                                                         onclick="img_confirm_delete('settings','{{$setting->id}}','icon','your Icon')">
                                                        <span class="btn btn-info btn-sm">@lang('Remove')</span>
                                                        <span class="btn btn-danger btn-sm">&times;</span>
                                                    </div>
                                                @else
                                                    <div class="image-upload">
                                                        <label for="icon-upload">
                                                            <img src="{{asset('img/icon.png')}}" id="preview_icon"
                                                                 class="img-responsive">
                                                        </label>
                                                        <input type="file" value="" class="file-upload standard_width"
                                                               id="icon-upload" accept="image/*">
                                                    </div>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 pr-0 ex-w-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">@lang('SMS Section')</div>
                            <div class="panel-body">
                                <table class="table table-responsive">
                                    <tbody>
                                    <tr>
                                        <td>@lang('SMS Send Panel')</td>
                                        <td>
                                            <a href="javascript:void(0)" class="fied-required editable editable-click"
                                               data-name="sms_self" data-type="select" data-pk="2"
                                               data-source="{{ json_encode(['1'=>'Self','0'=>'Foqas Academy']) }}"
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting->sms_self}}"
                                               data-value="{{ $setting->sms_self }}" data-original-title=""
                                               title="@lang('SMS Send Panel')">{{ $setting->sms_self == 1 ? 'Self' : 'Foqas Academy' }}</a>
                                        </td>
                                    </tr>
                                    @if($setting->sms_self == 1)
                                        <tr>
                                            <td>@lang('SMS Api Key')</td>
                                            <td>
                                                <a href="javascript:void(0)"
                                                   class="fied-required editable editable-click"
                                                   data-name="sms_api_key"
                                                   data-type="text" data-pk="2" data-source=""
                                                   data-url="{{ route('setting.update') }}"
                                                   data-title="{{ $setting->sms_api_key}}"
                                                   data-value="{{ $setting->sms_api_key }}" data-original-title=""
                                                   title="@lang('SMS Api Key')">{{ $setting->sms_api_key }}</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>@lang('SMS Sender ID')</td>
                                            <td>
                                                <a href="javascript:void(0)"
                                                   class="fied-required editable editable-click"
                                                   data-name="sms_sender_id"
                                                   data-type="text" data-pk="2" data-source=""
                                                   data-url="{{ route('setting.update') }}"
                                                   data-title="{{ $setting->sms_sender_id}}"
                                                   data-value="{{ $setting->sms_sender_id }}" data-original-title=""
                                                   title="@lang('SMS Sender ID')">{{ $setting->sms_sender_id }}</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>@lang('SMS Balance')</td>
                                            <td>
                                                @if(isset($setting->sms_api_key) && isset($setting->sms_sender_id))
                                                    @if($sms_balance)
                                                        {{number_format($sms_balance->balance,2)}} {{getCountryByName($sms_balance->country)->currency}}
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td>@lang('Total SMS Sent')</td>
                                            <td>
                                                {{$setting->school->sms_count}}
                                            </td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td>@lang('Admission Submitted Send SMS')</td>
                                        <td>
                                            <a href="javascript:void(0)"
                                               class="fied-required editable editable-click"
                                               data-name="admission_submit_sms"
                                               data-type="select" data-pk="2"
                                               data-source="{{ json_encode(['1'=>'Yes','0'=>'No']) }}"
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting->admission_submit_sms}}"
                                               data-value="{{ $setting->admission_submit_sms }}" data-original-title=""
                                               title="@lang('Admission Submited Sent SMS')">{{ $setting->admission_submit_sms == 1 ? 'Yes' : 'No' }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Admission Submitted Form Admin Send SMS')</td>
                                        <td>
                                            <a href="javascript:void(0)"
                                               class="fied-required editable editable-click"
                                               data-name="admission_submit_admin_sms"
                                               data-type="select" data-pk="2"
                                               data-source="{{ json_encode(['1'=>'Yes','0'=>'No']) }}"
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting->admission_submit_admin_sms}}"
                                               data-value="{{ $setting->admission_submit_admin_sms }}"
                                               data-original-title=""
                                               title="@lang('Admission Submited Form Admin Sent SMS')">{{ $setting->admission_submit_admin_sms == 1 ? 'Yes' : 'No' }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Admission Payment Send SMS')</td>
                                        <td>
                                            <a href="javascript:void(0)"
                                               class="fied-required editable editable-click"
                                               data-name="admission_payment_sms"
                                               data-type="select" data-pk="2"
                                               data-source="{{ json_encode(['1'=>'Yes','0'=>'No']) }}"
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting->admission_payment_sms}}"
                                               data-value="{{ $setting->admission_payment_sms }}" data-original-title=""
                                               title="@lang('Admission Submited Form Admin Sent SMS')">{{ $setting->admission_payment_sms == 1 ? 'Yes' : 'No' }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Admission Approved Send SMS')</td>
                                        <td>
                                            <a href="javascript:void(0)"
                                               class="fied-required editable editable-click"
                                               data-name="admission_approved_sms"
                                               data-type="select" data-pk="2"
                                               data-source="{{ json_encode(['1'=>'Yes','0'=>'No']) }}"
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting->admission_approved_sms}}"
                                               data-value="{{ $setting->admission_approved_sms }}"
                                               data-original-title=""
                                               title="@lang('Admission Approved Sent SMS')">{{ $setting->admission_approved_sms == 1 ? 'Yes' : 'No' }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Student Notification Send SMS')</td>
                                        <td>
                                            <a href="javascript:void(0)"
                                               class="fied-required editable editable-click"
                                               data-name="addmi_submit_admin_sms"
                                               data-type="select" data-pk="2"
                                               data-source="{{ json_encode(['1'=>'Yes','0'=>'No']) }}"
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting->notification_sms}}"
                                               data-value="{{ $setting->notification_sms }}" data-original-title=""
                                               title="@lang('Student Notification Sent SMS')">{{ $setting->notification_sms == 1 ? 'Yes' : 'No' }}</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 pr-0  ex-w-lg-4 cus-w-pl-15 pl-0">
                        <div class="panel panel-default">
                            <div class="panel-heading">@lang('Ledger Section')</div>
                            <div class="panel-body">
                                <table class="table table-responsive">
                                    <tbody>
                                    <tr>
                                        <td>@lang('Invoice Copy')</td>
                                        <td>
                                            <a href="javascript:void(0)" class="fied-required editable editable-click"
                                               data-name="invoice_copy"
                                               data-type="select" data-pk="2"
                                              {{-- data-source="{{ json_encode(['1'=>'Student','2'=>'Student & School','3'=>'Student, School & Bank']) }}"--}}
                                               data-source="{{ json_encode(['1'=>'Student','2'=>'Student & School']) }}"
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting->invoice_copy}}"
                                               data-value="{{ $setting->invoice_copy }}" data-original-title=""
                                               title="@lang('Invoice Copy')">{{ $setting->invoice_copy == 1 ? 'Student' : ($setting->invoice_copy == 2 ? 'Student & School' : 'Student, School & Bank') }}</a>
                                        </td>
                                    </tr>
                                    {{--<tr>
                                        <td>@lang('Invoice Template')</td>
                                        <td>
                                            <a href="javascript:void(0)" class="fied-required editable editable-click"
                                               data-name="invoice_template"
                                               data-type="select" data-pk="2"
                                               data-source="{{ json_encode(['1'=>'Invoice One','2'=>'Invoice Two','3'=>'Invoice Three']) }}"
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting->invoice_template}}"
                                               data-value="{{ $setting->invoice_template }}" data-original-title=""
                                               title="@lang('Invoice Template')">{{ $setting->invoice_template == 1 ? 'Invoice One' : ($setting->invoice_template == 2 ? 'Invoice Two' : 'Invoice Three') }}</a>
                                        </td>
                                    </tr> --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-3 pr-0 ex-w-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">@lang('Social Section')</div>
                            <div class="panel-body">
                                <table class="table table-responsive">
                                    <tbody>
                                    <tr>
                                        <td>@lang('Facebook')</td>
                                        <td>
                                            <a href="javascript:void(0)" class="fied-required editable editable-click"
                                               data-name="facebook"
                                               data-type="text" data-pk="2" data-source=""
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting->facebook}}"
                                               data-value="{{ $setting->facebook }}" data-original-title=""
                                               title="@lang('Facebook link')">{{ $setting->facebook }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Twitter')</td>
                                        <td>
                                            <a href="javascript:void(0)" class="fied-required editable editable-click"
                                               data-name="twitter"
                                               data-type="text" data-pk="2" data-source=""
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting->twitter}}"
                                               data-value="{{ $setting->twitter }}" data-original-title=""
                                               title="@lang('Twitter link')">{{ $setting->twitter }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Linkedin')</td>
                                        <td>
                                            <a href="javascript:void(0)" class="fied-required editable editable-click"
                                               data-name="linkedin"
                                               data-type="text" data-pk="2" data-source=""
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting->linkedin}}"
                                               data-value="{{ $setting->linkedin }}" data-original-title=""
                                               title="@lang('Linkedin link')">{{ $setting->linkedin }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Pinterest')</td>
                                        <td>
                                            <a href="javascript:void(0)" class="fied-required editable editable-click"
                                               data-name="pinterest"
                                               data-type="text" data-pk="2" data-source=""
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting->pinterest}}"
                                               data-value="{{ $setting->pinterest }}" data-original-title=""
                                               title="@lang('Pinterest link')">{{ $setting->pinterest }}</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 pl-0 pr-0 ex-w-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">@lang('Security Section')</div>
                            <div class="panel-body">
                                <table class="table table-responsive">
                                    <tbody>
                                    <tr>
                                        <td>@lang('ON/OFF website')</td>
                                        <td>
                                            <a href="javascript:void(0)" class="fied-required editable editable-click"
                                               data-name="site_published"
                                               data-type="select" data-pk="2"
                                               data-source="{{ json_encode(['1'=>'ON','0'=>'OFF']) }}"
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting->site_published}}"
                                               data-value="{{ $setting->site_published }}" data-original-title=""
                                               title="@lang('ON/OFF website')">{{ $setting->site_published == 1 ? 'ON' : 'OFF' }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Site UnPublished Message')</td>
                                        <td>
                                            <a href="javascript:void(0)" class="fied-required editable editable-click"
                                               data-name="unpublished_msg"
                                               data-type="text" data-pk="2"
                                               data-source=""
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting->unpublished_msg}}"
                                               data-value="{{ $setting->unpublished_msg }}" data-original-title=""
                                               title="@lang('Site UnPublished Message')">{{ $setting->unpublished_msg  }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('User Verify By Email')</td>
                                        <td>
                                            <a href="javascript:void(0)" class="fied-required editable editable-click"
                                               data-name="user_verify"
                                               data-type="select" data-pk="2"
                                               data-source="{{ json_encode(['1'=>'YES','0'=>'NO']) }}"
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting->user_verify}}"
                                               data-value="{{ $setting->user_verify }}" data-original-title=""
                                               title="@lang('User Verify By Email')">{{ $setting->user_verify == 1 ? 'YES' : 'NO' }}</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 pr-0 mt-3 ex-w-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">@lang('Contact Information')</div>
                            <div class="panel-body">
                                <table class="table table-responsive">
                                    <tbody>
                                    <tr>
                                        <td>@lang('Email')</td>
                                        <td>
                                            <a href="javascript:void(0)"
                                               class="required fied-required editable editable-click"
                                               data-name="email"
                                               data-type="text" data-pk="2" data-source=""
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting->email }}"
                                               data-value="{{ $setting->email }}" data-original-title=""
                                               title="@lang('School Email')">{{ $setting->email }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Phone')</td>
                                        <td>
                                            <a href="javascript:void(0)"
                                               class="required fied-required editable editable-click"
                                               data-name="phone"
                                               data-type="text" data-pk="2" data-source=""
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting->phone}}"
                                               data-value="{{ $setting->phone }}" data-original-title=""
                                               title="@lang('Phone')">{{ $setting->phone }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Telephone')</td>
                                        <td>
                                            <a href="javascript:void(0)" class="fied-required editable editable-click"
                                               data-name="telephone"
                                               data-type="text" data-pk="2" data-source=""
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting->telephone}}"
                                               data-value="{{ $setting->telephone }}" data-original-title=""
                                               title="@lang('Telephone')">{{ $setting->telephone }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Address')</td>
                                        <td>
                                            <a href="javascript:void(0)"
                                               class="required fied-required editable editable-click"
                                               data-name="address"
                                               data-type="text" data-pk="1" data-source=""
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting['school']->address }}"
                                               data-value="{{ $setting['school']->address }}" data-original-title=""
                                               title="@lang('School Address')">{{ $setting['school']->address }}</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @if(school('country')->code == 'BD')
                        <div class="col-md-6 pl-0 pr-0 mt-3 cus-w-pl-15 ex-w-lg-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">@lang('Sslcommerz')</div>
                                <div class="panel-body">
                                    <table class="table table-responsive">
                                        <tbody>
                                        <tr>
                                            <td>@lang('Sslcommerz Panel')</td>
                                            <td>
                                                <a href="javascript:void(0)"
                                                   class="fied-required editable editable-click"
                                                   data-name="ssl_self" data-type="select" data-pk="2"
                                                   data-source="{{ json_encode(['1'=>'Self','0'=>'Foqas Academy']) }}"
                                                   data-url="{{ route('setting.update') }}"
                                                   data-title="{{ $setting->ssl_self}}"
                                                   data-value="{{ $setting->ssl_self }}" data-original-title=""
                                                   title="@lang('Sslcommerz Panel')">{{ $setting->ssl_self == 1 ? 'Self' : 'Foqas Academy' }}</a>
                                            </td>
                                        </tr>
                                        @if($setting->ssl_self == 1)
                                            <tr>
                                                <td>@lang('SSL Store ID')</td>
                                                <td>
                                                    <a href="javascript:void(0)"
                                                       class="fied-required editable editable-click"
                                                       data-name="ssl_store_id"
                                                       data-type="text" data-pk="2" data-source=""
                                                       data-url="{{ route('setting.update') }}"
                                                       data-title="{{ $setting->ssl_store_id}}"
                                                       data-value="{{ $setting->ssl_store_id }}" data-original-title=""
                                                       title="@lang('SSL Store ID')">{{ $setting->ssl_store_id }}</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>@lang('SSL Store Password')</td>
                                                <td>
                                                    <a href="javascript:void(0)"
                                                       class="fied-required editable editable-click"
                                                       data-name="ssl_store_password"
                                                       data-type="text" data-pk="2" data-source=""
                                                       data-url="{{ route('setting.update') }}"
                                                       data-title="{{ $setting->ssl_store_password}}"
                                                       data-value="{{ $setting->ssl_store_password }}"
                                                       data-original-title=""
                                                       title="@lang('SSL Store Password')">{{ $setting->ssl_store_password }}</a>
                                                </td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="col-md-6 pr-0 mt-3 ex-w-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">@lang('Exam Section')</div>
                            <div class="panel-body">
                                <table class="table table-responsive">
                                    <tbody>
                                    <tr>
                                        <td>@lang('Marksheet Design')</td>
                                        <td>
                                            <a href="javascript:void(0)"
                                               class="fied-required editable editable-click"
                                               data-name="marksheet_tem" data-type="select" data-pk="2"
                                               data-source="{{ json_encode(['1'=>'Template One','2'=>'Template Two']) }}"
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting->marksheet_tem}}"
                                               data-value="{{ $setting->marksheet_tem }}" data-original-title=""
                                               title="@lang('Marksheet Design')">{{ $setting->marksheet_tem == 1 ? 'Template One' : 'Template Two' }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Marksheet with Class Teacher')</td>
                                        <td>
                                            <a href="javascript:void(0)"
                                               class="fied-required editable editable-click"
                                               data-name="marksheet_ctn" data-type="select" data-pk="2"
                                               data-source="{{ json_encode(['1'=>'Yes','0'=>'No']) }}"
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting->marksheet_ctn}}"
                                               data-value="{{ $setting->marksheet_ctn }}" data-original-title=""
                                               title="@lang('Marksheet with Class Teacher')">{{ $setting->marksheet_ctn == 1 ? 'Yes' : 'No' }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Marksheet with address')</td>
                                        <td>
                                            <a href="javascript:void(0)"
                                               class="fied-required editable editable-click"
                                               data-name="marksheet_address" data-type="select" data-pk="2"
                                               data-source="{{ json_encode(['1'=>'Yes','0'=>'No']) }}"
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting->marksheet_address}}"
                                               data-value="{{ $setting->marksheet_address }}" data-original-title=""
                                               title="@lang('Marksheet with address')">{{ $setting->marksheet_address == 1 ? 'Yes' : 'No' }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Marksheet with established')</td>
                                        <td>
                                            <a href="javascript:void(0)"
                                               class="fied-required editable editable-click"
                                               data-name="marksheet_established" data-type="select" data-pk="2"
                                               data-source="{{ json_encode(['1'=>'Yes','0'=>'No']) }}"
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting->marksheet_established}}"
                                               data-value="{{ $setting->marksheet_established }}" data-original-title=""
                                               title="@lang('Marksheet with established')">{{ $setting->marksheet_established == 1 ? 'Yes' : 'No' }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Marksheet with Signature')</td>
                                        <td>
                                            <a href="javascript:void(0)"
                                               class="fied-required editable editable-click"
                                               data-name="marksheet_signature" data-type="select" data-pk="2"
                                               data-source="{{ json_encode(['1'=>'Yes','0'=>'No']) }}"
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting->marksheet_signature }}"
                                               data-value="{{ $setting->marksheet_signature }}" data-original-title=""
                                               title="@lang('Marksheet with Signature')">{{ $setting->marksheet_signature == 1 ? 'Yes' : 'No' }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Marksheet Signature Type')</td>
                                        <td>
                                            <a href="javascript:void(0)"
                                               class="fied-required editable editable-click"
                                               data-name="marksheet_signature_type" data-type="select" data-pk="2"
                                               data-source="{{ json_encode(['1'=>'Head Of the Institute','2'=>'Principal Signature,Signature of Class Teacher','3'=>'Principal Signature,Signature of Class Teacher,Signature of Guardian']) }}"
                                               data-url="{{ route('setting.update') }}"
                                               data-title="{{ $setting->marksheet_signature_type}}"
                                               data-value="{{ $setting->marksheet_signature_type }}"
                                               data-original-title=""
                                               title="@lang('Marksheet Signature Type')">{{ $setting->marksheet_signature_type == 1 ? 'Head Of the Institute' : ($setting->marksheet_signature == 1 ? 'Principal Signature,Signature of Class Teacher' : 'Principal Signature,Signature of Class Teacher,Signature of Guardian') }}</a>
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
    </div>
    @include('components.editable')
@endsection
@push('styles')
    <style>
        table a:not(.btn), .table a:not(.btn) {
            text-decoration: none !important;
        }
    </style>
    <link rel="stylesheet" href="{{asset('additional/editable/datetimepicker.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.3.3/css/bootstrap-colorpicker.min.css"
          rel="stylesheet">
@endpush
@push('script')
    <script src="{{ asset('additional/editable/datetimepicker.js')}}"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.3.3/js/bootstrap-colorpicker.min.js"></script>
    <script src="{{ asset('additional/moment.min.js')}}"></script>
@endpush
