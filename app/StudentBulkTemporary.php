<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentBulkTemporary extends Model
{
    protected $fillable  = ['admission_number','matric_number', 'roll_no', 'first_name', 'last_name', 'date_of_birth', 'religion', 'gender', 'mobile', 'email', 'admission_date', 'blood_group', 'height', 'weight', 'guardian_name', 'guardian_relation', 'guardian_email', 'guardian_mobile', 'guardian_occupation', 'guardian_address', 'current_address', 'permanent_address', 'bank_account_no', 'bank_name', 'national_identification_no', 'local_identification_no', 'previous_school_details', 'note', 'user_id'];
}