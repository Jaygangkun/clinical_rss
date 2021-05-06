<?php
if(!function_exists('getAllStudies')){
    function getAllStudies(){
        return array(
			array(
				'value' => '',
				'text' => "All Studies"
			),
			array(
				'value' => 'Intr',
				'text' => "Interventional Studies (Clinical Trials)"
			),
			array(
				'value' => 'Obsr',
				'text' => "Observational Studies"
			),
			array(
				'value' => 'PReg',
				'text' => "   -- Patient Registries"
			),
			array(
				'value' => 'Expn',
				'text' => "Expanded Access Studies"
			)
		);
    }
}

if(!function_exists('getAllCountries')){
    function getAllCountries(){
        return array(
			array(
				'value' => '',
				'text' => "Country"
			),
			array(
				'value' => 'US',
				'text' => "United States"
			),
			array(
				'value' => 'AF',
				'text' => "Afghanistan"
			),
			array(
				'value' => 'AL',
				'text' => "Albania"
			),
			array(
				'value' => 'DZ',
				'text' => "Algeria"
			),
			array(
				'value' => 'AS',
				'text' => "American Samoa"
			),
			array(
				'value' => 'AD',
				'text' => "Andorra"
			),
			array(
				'value' => 'AO',
				'text' => "Angola"
			),
			array(
				'value' => 'AG',
				'text' => "Antigua and Barbuda"
			),
			array(
				'value' => 'AR',
				'text' => "Argentina"
			),
			array(
				'value' => 'AM',
				'text' => "Armenia"
			),
			array(
				'value' => 'AW',
				'text' => "Aruba"
			),
			array(
				'value' => 'AU',
				'text' => "Australia"
			),
			array(
				'value' => 'AT',
				'text' => "Austria"
			),
			array(
				'value' => 'AZ',
				'text' => "Azerbaijan"
			),
			array(
				'value' => 'BS',
				'text' => "Bahamas"
			),
			array(
				'value' => 'BH',
				'text' => "Bahrain"
			),
			array(
				'value' => 'BD',
				'text' => "Bangladesh"
			),
			array(
				'value' => 'BB',
				'text' => "Barbados"
			),
			array(
				'value' => 'BY',
				'text' => "Belarus"
			),
			array(
				'value' => 'BE',
				'text' => "Belgium"
			),
			array(
				'value' => 'BZ',
				'text' => "Belize"
			),
			array(
				'value' => 'BJ',
				'text' => "Benin"
			),
			array(
				'value' => 'BM',
				'text' => "Bermuda"
			),
			array(
				'value' => 'BT',
				'text' => "Bhutan"
			),
			array(
				'value' => 'BO',
				'text' => "Bolivia"
			),
			array(
				'value' => 'BA',
				'text' => "Bosnia and Herzegovina"
			),
			array(
				'value' => 'BW',
				'text' => "Botswana"
			),
			array(
				'value' => 'BR',
				'text' => "Brazil"
			),
			array(
				'value' => 'BN',
				'text' => "Brunei Darussalam"
			),
			array(
				'value' => 'BG',
				'text' => "Bulgaria"
			),
			array(
				'value' => 'BF',
				'text' => "Burkina Faso"
			),
			array(
				'value' => 'BI',
				'text' => "Burundi"
			),
			array(
				'value' => 'KH',
				'text' => "Cambodia"
			),
			array(
				'value' => 'CM',
				'text' => "Cameroon"
			),
			array(
				'value' => 'CA',
				'text' => "Canada"
			),
			array(
				'value' => 'CV',
				'text' => "Cape Verde"
			),
			array(
				'value' => 'KY',
				'text' => "Cayman Islands"
			),
			array(
				'value' => 'CF',
				'text' => "Central African Republic"
			),
			array(
				'value' => 'TD',
				'text' => "Chad"
			),
			array(
				'value' => 'CL',
				'text' => "Chile"
			),
			array(
				'value' => 'CN',
				'text' => "China"
			),
			array(
				'value' => 'CO',
				'text' => "Colombia"
			),
			array(
				'value' => 'KM',
				'text' => "Comoros"
			),
			array(
				'value' => 'CG',
				'text' => "Congo"
			),
			array(
				'value' => 'CD',
				'text' => "Congo, The Democratic Republic of the"
			),
			array(
				'value' => 'CR',
				'text' => "Costa Rica"
			),
			array(
				'value' => 'HR',
				'text' => "Croatia"
			),
			array(
				'value' => 'CU',
				'text' => "Cuba"
			),
			array(
				'value' => 'CY',
				'text' => "Cyprus"
			),
			array(
				'value' => 'CZ',
				'text' => "Czech Republic"
			),
			array(
				'value' => 'CI',
				'text' => "Côte D'Ivoire"
			),
			array(
				'value' => 'DK',
				'text' => "Denmark"
			),
			array(
				'value' => 'DJ',
				'text' => "Djibouti"
			),
			array(
				'value' => 'DM',
				'text' => "Dominica"
			),
			array(
				'value' => 'DO',
				'text' => "Dominican Republic"
			),
			array(
				'value' => 'EC',
				'text' => "Ecuador"
			),
			array(
				'value' => 'EG',
				'text' => "Egypt"
			),
			array(
				'value' => 'SV',
				'text' => "El Salvador"
			),
			array(
				'value' => 'GQ',
				'text' => "Equatorial Guinea"
			),
			array(
				'value' => 'ER',
				'text' => "Eritrea"
			),
			array(
				'value' => 'EE',
				'text' => "Estonia"
			),
			array(
				'value' => 'ET',
				'text' => "Ethiopia"
			),
			array(
				'value' => 'FO',
				'text' => "Faroe Islands"
			),
			array(
				'value' => 'FJ',
				'text' => "Fiji"
			),
			array(
				'value' => 'FI',
				'text' => "Finland"
			),
			array(
				'value' => 'CS',
				'text' => "Former Serbia and Montenegro"
			),
			array(
				'value' => 'YU',
				'text' => "Former Yugoslavia"
			),
			array(
				'value' => 'FR',
				'text' => "France"
			),
			array(
				'value' => 'GF',
				'text' => "French Guiana"
			),
			array(
				'value' => 'PF',
				'text' => "French Polynesia"
			),
			array(
				'value' => 'GA',
				'text' => "Gabon"
			),
			array(
				'value' => 'GM',
				'text' => "Gambia"
			),
			array(
				'value' => 'GE',
				'text' => "Georgia"
			),
			array(
				'value' => 'DE',
				'text' => "Germany"
			),
			array(
				'value' => 'GH',
				'text' => "Ghana"
			),
			array(
				'value' => 'GI',
				'text' => "Gibraltar"
			),
			array(
				'value' => 'GR',
				'text' => "Greece"
			),
			array(
				'value' => 'GL',
				'text' => "Greenland"
			),
			array(
				'value' => 'GD',
				'text' => "Grenada"
			),
			array(
				'value' => 'GP',
				'text' => "Guadeloupe"
			),
			array(
				'value' => 'GU',
				'text' => "Guam"
			),
			array(
				'value' => 'GT',
				'text' => "Guatemala"
			),
			array(
				'value' => 'GN',
				'text' => "Guinea"
			),
			array(
				'value' => 'GW',
				'text' => "Guinea-Bissau"
			),
			array(
				'value' => 'GY',
				'text' => "Guyana"
			),
			array(
				'value' => 'HT',
				'text' => "Haiti"
			),
			array(
				'value' => 'VA',
				'text' => "Holy See (Vatican City State)"
			),
			array(
				'value' => 'HN',
				'text' => "Honduras"
			),
			array(
				'value' => 'HK',
				'text' => "Hong Kong"
			),
			array(
				'value' => 'HU',
				'text' => "Hungary"
			),
			array(
				'value' => 'IS',
				'text' => "Iceland"
			),
			array(
				'value' => 'IN',
				'text' => "India"
			),
			array(
				'value' => 'ID',
				'text' => "Indonesia"
			),
			array(
				'value' => 'IR',
				'text' => "Iran, Islamic Republic of"
			),
			array(
				'value' => 'IQ',
				'text' => "Iraq"
			),
			array(
				'value' => 'IE',
				'text' => "Ireland"
			),
			array(
				'value' => 'IL',
				'text' => "Israel"
			),
			array(
				'value' => 'IT',
				'text' => "Italy"
			),
			array(
				'value' => 'JM',
				'text' => "Jamaica"
			),
			array(
				'value' => 'JP',
				'text' => "Japan"
			),
			array(
				'value' => 'JE',
				'text' => "Jersey"
			),
			array(
				'value' => 'JO',
				'text' => "Jordan"
			),
			array(
				'value' => 'KZ',
				'text' => "Kazakhstan"
			),
			array(
				'value' => 'KE',
				'text' => "Kenya"
			),
			array(
				'value' => 'KI',
				'text' => "Kiribati"
			),
			array(
				'value' => 'KP',
				'text' => "Korea, Democratic People's Republic of"
			),
			array(
				'value' => 'KR',
				'text' => "Korea, Republic of"
			),
			array(
				'value' => 'KW',
				'text' => "Kuwait"
			),
			array(
				'value' => 'KG',
				'text' => "Kyrgyzstan"
			),
			array(
				'value' => 'LA',
				'text' => "Lao People's Democratic Republic"
			),
			array(
				'value' => 'LV',
				'text' => "Latvia"
			),
			array(
				'value' => 'LB',
				'text' => "Lebanon"
			),
			array(
				'value' => 'LS',
				'text' => "Lesotho"
			),
			array(
				'value' => 'LR',
				'text' => "Liberia"
			),
			array(
				'value' => 'LY',
				'text' => "Libyan Arab Jamahiriya"
			),
			array(
				'value' => 'LI',
				'text' => "Liechtenstein"
			),
			array(
				'value' => 'LT',
				'text' => "Lithuania"
			),
			array(
				'value' => 'LU',
				'text' => "Luxembourg"
			),
			array(
				'value' => 'MK',
				'text' => "Macedonia, The Former Yugoslav Republic of"
			),
			array(
				'value' => 'MG',
				'text' => "Madagascar"
			),
			array(
				'value' => 'MW',
				'text' => "Malawi"
			),
			array(
				'value' => 'MY',
				'text' => "Malaysia"
			),
			array(
				'value' => 'MV',
				'text' => "Maldives"
			),
			array(
				'value' => 'ML',
				'text' => "Mali"
			),
			array(
				'value' => 'MT',
				'text' => "Malta"
			),
			array(
				'value' => 'MQ',
				'text' => "Martinique"
			),
			array(
				'value' => 'MR',
				'text' => "Mauritania"
			),
			array(
				'value' => 'MU',
				'text' => "Mauritius"
			),
			array(
				'value' => 'YT',
				'text' => "Mayotte"
			),
			array(
				'value' => 'MX',
				'text' => "Mexico"
			),
			array(
				'value' => 'MD',
				'text' => "Moldova, Republic of"
			),
			array(
				'value' => 'MC',
				'text' => "Monaco"
			),
			array(
				'value' => 'MN',
				'text' => "Mongolia"
			),
			array(
				'value' => 'ME',
				'text' => "Montenegro"
			),
			array(
				'value' => 'MS',
				'text' => "Montserrat"
			),
			array(
				'value' => 'MA',
				'text' => "Morocco"
			),
			array(
				'value' => 'MZ',
				'text' => "Mozambique"
			),
			array(
				'value' => 'MM',
				'text' => "Myanmar"
			),
			array(
				'value' => 'NA',
				'text' => "Namibia"
			),
			array(
				'value' => 'NP',
				'text' => "Nepal"
			),
			array(
				'value' => 'NL',
				'text' => "Netherlands"
			),
			array(
				'value' => 'AN',
				'text' => "Netherlands Antilles"
			),
			array(
				'value' => 'NC',
				'text' => "New Caledonia"
			),
			array(
				'value' => 'NZ',
				'text' => "New Zealand"
			),
			array(
				'value' => 'NI',
				'text' => "Nicaragua"
			),
			array(
				'value' => 'NE',
				'text' => "Niger"
			),
			array(
				'value' => 'NG',
				'text' => "Nigeria"
			),
			array(
				'value' => 'MP',
				'text' => "Northern Mariana Islands"
			),
			array(
				'value' => 'NO',
				'text' => "Norway"
			),
			array(
				'value' => 'OM',
				'text' => "Oman"
			),
			array(
				'value' => 'PK',
				'text' => "Pakistan"
			),
			array(
				'value' => 'PW',
				'text' => "Palau"
			),
			array(
				'value' => 'PA',
				'text' => "Panama"
			),
			array(
				'value' => 'PG',
				'text' => "Papua New Guinea"
			),
			array(
				'value' => 'PY',
				'text' => "Paraguay"
			),
			array(
				'value' => 'PE',
				'text' => "Peru"
			),
			array(
				'value' => 'PH',
				'text' => "Philippines"
			),
			array(
				'value' => 'PL',
				'text' => "Poland"
			),
			array(
				'value' => 'PT',
				'text' => "Portugal"
			),
			array(
				'value' => 'PR',
				'text' => "Puerto Rico"
			),
			array(
				'value' => 'QA',
				'text' => "Qatar"
			),
			array(
				'value' => 'RO',
				'text' => "Romania"
			),
			array(
				'value' => 'RU',
				'text' => "Russian Federation"
			),
			array(
				'value' => 'RW',
				'text' => "Rwanda"
			),
			array(
				'value' => 'RE',
				'text' => "Réunion"
			),
			array(
				'value' => 'KN',
				'text' => "Saint Kitts and Nevis"
			),
			array(
				'value' => 'LC',
				'text' => "Saint Lucia"
			),
			array(
				'value' => 'VC',
				'text' => "Saint Vincent and the Grenadines"
			),
			array(
				'value' => 'WS',
				'text' => "Samoa"
			),
			array(
				'value' => 'SM',
				'text' => "San Marino"
			),
			array(
				'value' => 'SA',
				'text' => "Saudi Arabia"
			),
			array(
				'value' => 'SN',
				'text' => "Senegal"
			),
			array(
				'value' => 'RS',
				'text' => "Serbia"
			),
			array(
				'value' => 'SC',
				'text' => "Seychelles"
			),
			array(
				'value' => 'SL',
				'text' => "Sierra Leone"
			),
			array(
				'value' => 'SG',
				'text' => "Singapore"
			),
			array(
				'value' => 'SK',
				'text' => "Slovakia"
			),
			array(
				'value' => 'SI',
				'text' => "Slovenia"
			),
			array(
				'value' => 'SB',
				'text' => "Solomon Islands"
			),
			array(
				'value' => 'SO',
				'text' => "Somalia"
			),
			array(
				'value' => 'ZA',
				'text' => "South Africa"
			),
			array(
				'value' => 'SS',
				'text' => "South Sudan"
			),
			array(
				'value' => 'ES',
				'text' => "Spain"
			),
			array(
				'value' => 'LK',
				'text' => "Sri Lanka"
			),
			array(
				'value' => 'SD',
				'text' => "Sudan"
			),
			array(
				'value' => 'SR',
				'text' => "Suriname"
			),
			array(
				'value' => 'SZ',
				'text' => "Swaziland"
			),
			array(
				'value' => 'SE',
				'text' => "Sweden"
			),
			array(
				'value' => 'CH',
				'text' => "Switzerland"
			),
			array(
				'value' => 'SY',
				'text' => "Syrian Arab Republic"
			),
			array(
				'value' => 'TW',
				'text' => "Taiwan"
			),
			array(
				'value' => 'TJ',
				'text' => "Tajikistan"
			),
			array(
				'value' => 'TZ',
				'text' => "Tanzania"
			),
			array(
				'value' => 'TH',
				'text' => "Thailand"
			),
			array(
				'value' => 'TG',
				'text' => "Togo"
			),
			array(
				'value' => 'TT',
				'text' => "Trinidad and Tobago"
			),
			array(
				'value' => 'TN',
				'text' => "Tunisia"
			),
			array(
				'value' => 'TR',
				'text' => "Turkey"
			),
			array(
				'value' => 'UG',
				'text' => "Uganda"
			),
			array(
				'value' => 'UA',
				'text' => "Ukraine"
			),
			array(
				'value' => 'AE',
				'text' => "United Arab Emirates"
			),
			array(
				'value' => 'GB',
				'text' => "United Kingdom"
			),
			array(
				'value' => 'US',
				'text' => "United States"
			),
			array(
				'value' => 'UY',
				'text' => "Uruguay"
			),
			array(
				'value' => 'UZ',
				'text' => "Uzbekistan"
			),
			array(
				'value' => 'VU',
				'text' => "Vanuatu"
			),
			array(
				'value' => 'VE',
				'text' => "Venezuela"
			),
			array(
				'value' => 'VN',
				'text' => "Vietnam"
			),
			array(
				'value' => 'VI',
				'text' => "Virgin Islands (U.S.)"
			),
			array(
				'value' => 'YE',
				'text' => "Yemen"
			),
			array(
				'value' => 'ZM',
				'text' => "Zambia"
			),
			array(
				'value' => 'ZW',
				'text' => "Zimbabwe"
			)
		);
    }
}
?>