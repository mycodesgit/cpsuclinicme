<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Referral Form</title>

    <style>
        .details {			
			margin-left: 10px;
			text-align: left;
			font-size: 10pt;
		}
        .details-sm {			
			margin-left: 10px;
			text-align: left;
			font-size: 9pt;
		}
        .comment-lines hr {
	        border: none;
	        margin-top: 20px !important;
	        border-top: 1px solid #000;
	        margin: 10px 0;
	        width: 100%;
	    }

	    .comment-lines {
		    margin-top: 5px;
		}

		.line {
		    border-bottom: 1px solid black;
		    height: 20px; /* Adjust the height to match the lines in your image */
		    line-height: 20px;
		    padding-left: 5px;
		}
    </style>
</head>
<body>
    <header>
        <div style="text-align: center;">
            <img src="{{ public_path('style/dist/img/refheader.png') }}" width="90%" style="margin-top: -30px;">
        </div>
    </header>

    <div>
        <div class="details" style="margin-top: 10px; margin-left: 533px;">
            <span style="display: inline-block; width: 1px; vertical-align: top;">&nbsp;</span>
            <div style="display: inline-block; margin-left: 20px; vertical-align: top; text-align: center; border-bottom: 1px solid black; width: 160px;">
                <span style="font-weight: bold; text-transform: normal;">
                    {{ \Carbon\Carbon::parse($pref->date)->format('F d, Y') }}
                </span>
            </div>
            <div style="text-align: center; width: 200px; margin-left: 0px; font-family: DejaVu Sans,">
                <span>Date</span>
            </div>
        </div>

        <div class="details" style="margin-top: -5px;">
            <span style="display: inline-block; width: 55px; vertical-align: top; font-weight:bold; font-family: DejaVu Sans,">Name:</span>
            <div style="display: inline-block; margin-left: 5px; vertical-align: top; text-align: left; border-bottom: 1px solid black; width: 645px;">
                <span style="text-transform: capitalize;">{{ strtolower($pref->patient_fname) }} {{ strtolower(substr($pref->patient_mname, 0,1)) }}. {{ strtolower($pref->patient_lname) }}</span>
            </div>
        </div>

        <div class="details" style="">
            <span style="display: inline-block; width: 70px; vertical-align: top; font-weight:bold; font-family: DejaVu Sans,">Address:</span>
            <div style="display: inline-block; margin-left: 5px; vertical-align: top; text-align: left; border-bottom: 1px solid black; width: 630px;">
                <span style="text-transform: capitalize;">{{ strtolower($pref->bname) }}, {{ strtolower($pref->cname) }}, {{ strtolower($pref->pname) }}, {{ $pref->rname }}</span>
            </div>
        </div>

        <div class="details" style="">
            <span style="display: inline-block; width: 30px; vertical-align: top; font-weight:bold; font-family: DejaVu Sans,">Age:</span>
            <div style="display: inline-block; margin-left: 5px; vertical-align: top; text-align: left; border-bottom: 1px solid black; width: 50px;">
                <span style="text-transform: capitalize;">&nbsp;</span>
            </div>
            <span style="display: inline-block; width: 120px; vertical-align: top; font-weight:bold; margin-left: 15px; font-family: DejaVu Sans,">Date of Birth:</span>
            <div style="display: inline-block; margin-left: 0px; vertical-align: top; text-align: left; border-bottom: 1px solid black; width: 120px;">
                <span style="text-transform: capitalize;">{{ \Carbon\Carbon::parse($pref->birthdate)->format('F d, Y') }}</span>
            </div>
            <span style="display: inline-block; width: 105px; vertical-align: top; font-weight:bold; margin-left: 15px; font-family: DejaVu Sans,">Civil Status:</span>
            <div style="display: inline-block; margin-left: 0px; vertical-align: top; text-align: left; border-bottom: 1px solid black; width: 90px;">
                <span style="text-transform: capitalize;">{{ strtolower($pref->c_status) }}</span>
            </div>
            <span style="display: inline-block; width: 30px; vertical-align: top; font-weight:bold; margin-left: 13px; font-family: DejaVu Sans,">Sex:</span>
            <div style="display: inline-block; margin-left: 5px; vertical-align: top; text-align: left; border-bottom: 1px solid black; width: 85px;">
                <span style="text-transform: capitalize;">{{ strtolower($pref->sex) }}</span>
            </div>
        </div>

        <div class="details" style="margin-top: 5px;">
            <div style="display: inline-block; margin-left: 5px; vertical-align: top; text-align: left; width: 20px; margin-top: -5px;">
                <span style="font-family: DejaVu Sans, sans-serif; text-transform: uppercase;">
                    ({{ $pref->category == 'Student' ? '✔' : ' ' }})
                </span>
            </div>
            <span style="display: inline-block; width: 30px; vertical-align: top; font-weight:bold; margin-left: 5px">Student</span>

            <div style="display: inline-block; margin-left: 35px; vertical-align: top; text-align: left; width: 20px; margin-top: -5px;">
                <span style="font-family: DejaVu Sans, sans-serif; text-transform: uppercase;">
                    ({{ $pref->category == 'Employee' ? '✔' : ' ' }})
                </span>
            </div>
            <span style="display: inline-block; width: 80px; vertical-align: top; font-weight:bold">Personnel</span>

            <span style="display: inline-block; width: 180px; vertical-align: top; font-weight:bold; margin-left: 15px;">Ocupation/Year & Section:</span>
            <div style="display: inline-block; margin-left: 0px; vertical-align: top; text-align: left; border-bottom: 1px solid black; width: 301px;">
                <span style="text-transform: uppercase;">sdsd</span>
            </div>
        </div>

        <div class="details" style="margin-top: 10px;">
            <span style="display: inline-block; width: 98px; vertical-align: top; font-weight:bold">Referred from:</span>
            <div style="display: inline-block; vertical-align: top; text-align: left; width: 150px; margin-left: 35px; margin-top: -5px !important">
                <span style="font-weight: bold;">
                    <span style="font-family: DejaVu Sans, sans-serif; font-weight: bold;">
                        ({{ $pref->preferfrom == 'Medical Doctor' ? '✔' : ' ' }})
                    </span>
                    Medical Doctor
                </span>
            </div>
            <div style="display: inline-block; margin-left: 0px; vertical-align: top; text-align: left; width: 150px; margin-top: -5px !important">
                <span style="font-weight: bold;">
                    <span style="font-family: DejaVu Sans, sans-serif; font-weight: bold;">
                        ({{ $pref->preferfrom == 'School Nurse' ? '✔' : ' ' }})
                    </span>
                    School Nurse
                </span>
            </div>
            <div style="display: inline-block; margin-left: 0px; vertical-align: top; text-align: left; width: 170px; margin-top: -5px !important">
                <span style="font-weight: bold;">
                    <span style="font-family: DejaVu Sans, sans-serif; font-weight: bold;">
                        ({{ $pref->preferfrom == 'Dentist' ? '✔' : ' ' }})
                    </span>
                    Dentist
                </span>
            </div>
        </div>

        <div class="details" style="margin-top: 2px;">
            <span style="display: inline-block; width: 98px; vertical-align: top; font-weight:bold">Referred to:</span>
            <div style="display: inline-block; vertical-align: top; text-align: left; width: 150px; margin-left: 35px; margin-top: -5px !important">
                <span style="font-weight: bold;">
                    <span style="font-family: DejaVu Sans, sans-serif; font-weight: bold;">
                        ({{ $pref->preferto == 'Medical Doctor' ? '✔' : ' ' }})
                    </span>
                    Medical Doctor
                </span>
            </div>
            <div style="display: inline-block; margin-left: 0px; vertical-align: top; text-align: left; width: 150px; margin-top: -5px !important">
                <span style="font-weight: bold;">
                    <span style="font-family: DejaVu Sans, sans-serif; font-weight: bold;">
                        ({{ $pref->preferto == 'CHO' ? '✔' : ' ' }})
                    </span>
                    CHO
                </span>
            </div>
            <div style="display: inline-block; margin-left: 0px; vertical-align: top; text-align: left; width: 110px; margin-top: -5px !important">
                <span style="font-weight: bold;">
                    <span style="font-family: DejaVu Sans, sans-serif; font-weight: bold;">
                        ({{ $pref->preferto == 'Dentist' ? '✔' : ' ' }})
                    </span>
                    Dentist
                </span>
            </div>
            <div style="display: inline-block; margin-left: 0px; vertical-align: top; text-align: left; width: 120px; margin-top: -5px !important">
                <span style="font-weight: bold;">
                    <span style="font-family: DejaVu Sans, sans-serif; font-weight: bold;">
                        ({{ $pref->preferto == 'Radiologist' ? '✔' : ' ' }})
                    </span>
                    Radiologist
                </span>
            </div>
        </div>

        <div class="details" style="margin-top: 10px;">
            <span style="display: inline-block; width: 50px; vertical-align: top; font-weight:bold">Weight:</span>
            <div style="display: inline-block; margin-left: 2px; vertical-align: top; text-align: left; border-bottom: 1px solid black; width: 44px;">
                <span style="text-transform: uppercase;">&nbsp;</span>
            </div>
            <span style="display: inline-block; width: 10px; vertical-align: top; font-weight:bold; margin-left: 6px;">T:</span>
            <div style="display: inline-block; margin-left: 3px; vertical-align: top; text-align: left; border-bottom: 1px solid black; width: 44px;">
                <span style="text-transform: uppercase;">&nbsp;</span>
            </div>
            <span style="display: inline-block; width: 15px; vertical-align: top; font-weight:bold; margin-left: 6px;">BP:</span>
            <div style="display: inline-block; margin-left: 5px; vertical-align: top; text-align: left; border-bottom: 1px solid black; width: 44px;">
                <span style="text-transform: uppercase;">&nbsp;</span>
            </div>
            <span style="display: inline-block; width: 15px; vertical-align: top; font-weight:bold; margin-left: 6px;">HR:</span>
            <div style="display: inline-block; margin-left: 10px; vertical-align: top; text-align: left; border-bottom: 1px solid black; width: 44px;">
                <span style="text-transform: uppercase;">&nbsp;</span>
            </div>
            <span style="display: inline-block; width: 20px; vertical-align: top; font-weight:bold; margin-left: 6px;">SPO2:</span>
            <div style="display: inline-block; margin-left: 20px; vertical-align: top; text-align: left; border-bottom: 1px solid black; width: 44px;">
                <span style="text-transform: uppercase;">&nbsp;</span>
            </div>%
            <span style="display: inline-block; width: 15px; vertical-align: top; font-weight:bold; margin-left: 6px;">PR:</span>
            <div style="display: inline-block; margin-left: 10px; vertical-align: top; text-align: left; border-bottom: 1px solid black; width: 44px;">
                <span style="text-transform: uppercase;">&nbsp;</span>
            </div>
            <span style="display: inline-block; width: 20px; vertical-align: top; font-weight:bold; margin-left: 6px;">LMP:</span>
            <div style="display: inline-block; margin-left: 16px; vertical-align: top; text-align: left; border-bottom: 1px solid black; width: 44px;">
                <span style="text-transform: uppercase;">&nbsp;</span>
            </div>
            <span style="display: inline-block; width: 20px; vertical-align: top; font-weight:bold; margin-left: 6px;">AOG:</span>
            <div style="display: inline-block; margin-left: 13px; vertical-align: top; text-align: left; border-bottom: 1px solid black; width: 44px;">
                <span style="text-transform: uppercase;">&nbsp;</span>
            </div>
        </div>

        <div class="details" style="margin-top: 8px;">
            <label style="font-weight: bold; font-family: DejaVu Sans">Reason for Referral:</label>
            <div class="comment-lines">
                @php
		            $referreason = explode("\n", wordwrap($pref->reasonrefer ?? '', 900, "\n", true));
		        @endphp
		        @for($i = 0; $i < 3; $i++)
		            <div class="line">
		                {{ isset($referreason[$i]) ? $referreason[$i] : '' }}
		            </div>
		        @endfor
            </div>
        </div>

        <div class="details" style="margin-top: 8px;">
            <label style="font-weight: bold; font-family: DejaVu Sans">Tentative Diagnosis:</label>
            <div class="comment-lines">
                @php
		            $refertent = explode("\n", wordwrap($pref->tentdiagnose ?? '', 900, "\n", true));
		        @endphp
		        @for($i = 0; $i < 3; $i++)
		            <div class="line">
		                {{ isset($refertent[$i]) ? $refertent[$i] : '' }}
		            </div>
		        @endfor
            </div>
        </div>

        <div class="details" style="margin-top: 8px;">
            <label style="font-weight: bold; font-family: DejaVu Sans">Treatment/Medications Given:</label>
            <div class="comment-lines">
                @php
		            $refertreat = explode("\n", wordwrap($pref->treatmentmedgiven ?? '', 900, "\n", true));
		        @endphp
		        @for($i = 0; $i < 3; $i++)
		            <div class="line">
		                {{ isset($refertreat[$i]) ? $refertreat[$i] : '' }}
		            </div>
		        @endfor
            </div>
        </div>

        <div class="details" style="margin-top: 20px; margin-left: 320px;">
            <span style="display: inline-block; width: 1px; vertical-align: top;">&nbsp;</span>
            <div style="display: inline-block; margin-left: 20px; vertical-align: top; text-align: center; border-bottom: 1px solid black; width: 360px;">
                <span style="font-weight: bold; text-transform: normal;">
                    &nbsp;
                </span>
            </div>
            <div style="text-align: center; width: 320px; margin-left: 50px; font-family: DejaVu Sans,">
                <span style="font-size: 9pt !important;">Name and Signature of Examining Physician/Nurse</span>
            </div>
        </div>

        <div class="page-header" style="border-bottom: 2px solid #000000; margin-top: 20px"></div>

        <div class="details" style="margin-top: -10px;">
            <div style="text-align: center; font-family: Arial, sans-serif; font-size: 11pt;">
                <h4>RETURN REFERRAL SLIP</h4>
                <p style="margin-top: -15px; font-size: 8pt">(Please send back this from when accomplished)</p>
            </div>
        </div>

        <div class="details" style="margin-top: 10px; margin-left: 533px;">
            <span style="display: inline-block; width: 1px; vertical-align: top; font-family: DejaVu Sans">Date:</span>
            <div style="display: inline-block; margin-left: 50px; vertical-align: top; text-align: center; border-bottom: 1px solid black; width: 130px;">
                <span style="font-weight: bold; text-transform: normal;">
                    &nbsp;
                </span>
            </div>
        </div>

        <div class="details" style="margin-top: -10px;">
            <span style="display: inline-block; width: 20px; vertical-align: top; font-weight:bold; font-family: DejaVu Sans,">To:</span>
            <div style="display: inline-block; margin-left: 5px; vertical-align: top; text-align: left; border-bottom: 1px solid black; width: 300px;">
                <span style="text-transform: capitalize;">&nbsp;</span>
            </div>
        </div>
        <div class="details" style="">
            <span style="display: inline-block; width: 30px; vertical-align: top; font-weight:bold; font-family: DejaVu Sans,">From:</span>
            <div style="display: inline-block; margin-left: 20px; vertical-align: top; text-align: left; border-bottom: 1px solid black; width: 275px;">
                <span style="text-transform: capitalize;">&nbsp;</span>
            </div>
        </div>

        <div class="details" style="margin-top: 10px;">
            <span style="display: inline-block; width: 145px; vertical-align: top; font-weight:bold; font-family: DejaVu Sans,">Name of Patient:</span>
            <div style="display: inline-block; margin-left: 2px; vertical-align: top; text-align: left; border-bottom: 1px solid black; width: 555px;">
                <span style="text-transform: capitalize;">&nbsp;</span>
            </div>
        </div>

        <div class="details" style="">
            <span style="display: inline-block; width: 70px; vertical-align: top; font-weight:bold; font-family: DejaVu Sans,">Gender:</span>
            <div style="display: inline-block; margin-left: 0px; vertical-align: top; text-align: left; border-bottom: 1px solid black; width: 120px;">
                <span style="text-transform: capitalize;">&nbsp;</span>
            </div>
            <span style="display: inline-block; width: 105px; vertical-align: top; font-weight:bold; margin-left: 15px; font-family: DejaVu Sans,">Civil Status:</span>
            <div style="display: inline-block; margin-left: 0px; vertical-align: top; text-align: left; border-bottom: 1px solid black; width: 90px;">
                <span style="text-transform: capitalize;">&nbsp;</span>
            </div>
            <span style="display: inline-block; width: 80px; vertical-align: top; font-weight:bold; margin-left: 13px; font-family: DejaVu Sans,">Occupation:</span>
            <div style="display: inline-block; margin-left: 20px; vertical-align: top; text-align: left; border-bottom: 1px solid black; width: 173px;">
                <span style="text-transform: capitalize;">&nbsp;</span>
            </div>
        </div>

        <div class="details" style="">
            <span style="display: inline-block; width: 70px; vertical-align: top; font-weight:bold; font-family: DejaVu Sans,">Address:</span>
            <div style="display: inline-block; margin-left: 5px; vertical-align: top; text-align: left; border-bottom: 1px solid black; width: 630px;">
                <span style="text-transform: capitalize;">&nbsp;</span>
            </div>
        </div>

        <div class="details" style="">
            <span style="display: inline-block; width: 75px; vertical-align: top; font-weight:bold; font-family: DejaVu Sans,">Diagnosis:</span>
            <div style="display: inline-block; margin-left: 7px; vertical-align: top; text-align: left; border-bottom: 1px solid black; width: 622px;">
                <span style="text-transform: capitalize;">&nbsp;</span>
            </div>
            <div style="display: inline-block; margin-left: 85px; vertical-align: top; text-align: left; border-bottom: 1px solid black; width: 622px;">
                <span style="text-transform: capitalize;">&nbsp;</span>
            </div>
        </div>

        <div class="details" style="margin-top: 10px;">
            <span style="display: inline-block; width: 120px; vertical-align: top; font-weight:bold; font-family: DejaVu Sans,">Date Received:</span>
            <div style="display: inline-block; margin-left: 0px; vertical-align: top; text-align: left; border-bottom: 1px solid black; width: 585px;">
                <span style="text-transform: capitalize;">&nbsp;</span>
            </div>
        </div>

        <div class="details" style="">
            <span style="display: inline-block; width: 110px; vertical-align: top; font-weight:bold; font-family: DejaVu Sans,">Action Taken:</span>
            <div style="display: inline-block; margin-left: 0px; vertical-align: top; text-align: left; border-bottom: 1px solid black; width: 594px;">
                <span style="text-transform: capitalize;">&nbsp;</span>
            </div>
            <div style="display: inline-block; margin-left: 113px; vertical-align: top; text-align: left; border-bottom: 1px solid black; width: 594px;">
                <span style="text-transform: capitalize;">&nbsp;</span>
            </div>
        </div>

        <div class="details" style="margin-top: 5px;">
            <span style="display: inline-block; width: 50px; vertical-align: top; font-weight:bold; font-family: DejaVu Sans">Result:</span>
            <div style="display: inline-block; vertical-align: top; text-align: left; width: 100px; margin-left: 0px; margin-top: 15px !important">
                <span style="font-weight: bold;">
                    <span style="font-family: DejaVu Sans, sans-serif; font-weight: bold;">
                        ( )
                    </span>
                    Improved
                </span>
            </div>
            <div style="display: inline-block; margin-left: 20px; vertical-align: top; text-align: left; width: 100px; margin-top: 15px !important">
                <span style="font-weight: bold;">
                    <span style="font-family: DejaVu Sans, sans-serif; font-weight: bold;">
                        ( )
                    </span>
                    Unimproved
                </span>
            </div>
            <div style="display: inline-block; margin-left: 20px; vertical-align: top; text-align: left; width: 100px; margin-top: 15px !important">
                <span style="font-weight: bold;">
                    <span style="font-family: DejaVu Sans, sans-serif; font-weight: bold;">
                        ( )
                    </span>
                    Deceased
                </span>
            </div>
            <div style="display: inline-block; margin-left: 20px; vertical-align: top; text-align: left; width: 100px; margin-top: 15px !important">
                <span style="font-weight: bold;">
                    <span style="font-family: DejaVu Sans, sans-serif; font-weight: bold;">
                        ( )
                    </span>
                    Confirmed
                </span>
            </div>
        </div>
        <div class="details" style="margin-top: 0px;">
            <div style="display: inline-block; vertical-align: top; text-align: left; width: 650px; margin-left: 53px; margin-top: 0px !important">
                <span style="font-weight: bold;">
                    <span style="font-family: DejaVu Sans, sans-serif; font-weight: bold;">
                        ( )
                    </span>
                    Others (Please specify): _____________________________________________________________________
                </span>
            </div>
        </div>

        <div class="details" style="margin-top: 15px;">
            <label style="font-weight: bold; font-family: DejaVu Sans">Remarks:</label>
            <div class="comment-lines">
                @for($i = 0; $i < 2; $i++)
                    <div class="line">
                        &nbsp;
                    </div>
                @endfor
            </div>
        </div>

        <div class="details" style="margin-top: 20px; margin-left: 320px;">
            <span style="display: inline-block; width: 1px; vertical-align: top;">&nbsp;</span>
            <div style="display: inline-block; margin-left: 20px; vertical-align: top; text-align: center; border-bottom: 1px solid black; width: 360px;">
                <span style="font-weight: bold; text-transform: normal;">
                    &nbsp;
                </span>
            </div>
            <div style="text-align: center; width: 320px; margin-left: 50px; font-family: DejaVu Sans,">
                <span style="font-size: 9pt !important;">Name and Signature of Examining Medical Officer</span>
            </div>
        </div>

    </div>
</body>
</html>