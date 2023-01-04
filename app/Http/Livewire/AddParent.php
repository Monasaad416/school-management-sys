<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Nationality;
use App\Models\Blood;
use App\Models\Religion;
use App\Models\Myparent;
use App\Models\ParentAttachment;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class AddParent extends Component
{
    use WithFileUploads;

    public $current_screen;
    public $updateMode;
    public $photos;
    public $parent_id;
    public $email;
    public $password;

    public $father_name_ar;
    public $father_name_en;
    public $father_job_ar;
    public $father_job_en;
    public $father_national_ID;
    public $father_passport_ID;
    public $father_phone;
    public $father_nationality_id;
    public $father_blood_type_id;
    public $father_religion_id;
    public $father_address;

    public $mother_name_ar;
    public $mother_name_en;
    public $mother_job_ar;
    public $mother_job_en;
    public $mother_national_ID;
    public $mother_passport_ID;
    public $mother_phone;
    public $mother_nationality_id;
    public $mother_blood_type_id;
    public $mother_religion_id;
    public $mother_address;

    public function mount()
    {
        $this->current_screen = 1;
    }

    //real time validation for some inputs
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName,[
            'email' => 'required|email|unique:App\Models\Myparent,email',
            'father_national_ID' => 'required|unique:App\Models\Myparent,father_national_ID|regex:/[0-9]{9}/',
            'father_passport_ID' => 'required|unique:App\Models\Myparent,father_passport_ID|min:10|max:10',
            'father_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'mother_national_ID' => 'required|unique:App\Models\Myparent,mother_national_ID|regex:/[0-9]{9}/',
            'mother_passport_ID' => 'required|unique:App\Models\Myparent,mother_passport_ID',
            'mother_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ]);
    }
    //step #1
    public function firstStep()
    {
        $this->validate([
            'email' => 'required|unique:App\Models\Myparent,email',
            'password' => 'required',
            'father_name_ar' => 'required',
            'father_name_en' => 'required',
            'father_job_ar' => 'required',
            'father_job_en' => 'required',
            'father_national_ID' => 'required|unique:App\Models\Myparent,father_national_ID|regex:/[0-9]{9}/',
            'father_passport_ID' => 'unique:App\Models\Myparent,father_passport_ID|min:10|max:10',
            'father_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'father_nationality_id' => 'required',
            'father_blood_type_id' => 'required',
            'father_religion_id' => 'required',
            'father_address' => 'required',
        ]);
        $this->current_screen = 2;
    }


    public function back($current_screen)
    {
        $this->current_screen = $this->current_screen -1 ;
    }
    public function secStep()
    {
        $this->validate([
            'mother_name_ar' => 'required',
            'mother_name_en' => 'required',
            'mother_job_ar' => 'required',
            'mother_job_en' => 'required',
            'mother_national_ID' => 'required|unique:App\Models\Myparent,mother_national_ID|regex:/[0-9]{9}/',
            'mother_passport_ID' => 'required|unique:App\Models\Myparent,mother_passport_ID|min:10|max:10',
            'mother_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'mother_nationality_id' => 'required',
            'mother_blood_type_id' => 'required',
            'mother_religion_id' => 'required',
            'mother_address' => 'required',
        ]);
        $this->current_screen = 3;
    }

    public function submitForm()
    {
        try {
            Myparent::create([
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'father_name' => [
                   'en' => $this->father_name_ar,
                   'ar' => $this->father_name_en,
                ],
                'father_job' => [
                    'en' => $this->father_job_ar,
                    'ar' => $this->father_job_en,
                 ],
                 'father_national_ID' => $this->father_national_ID,
                 'father_passport_ID' => $this->father_passport_ID,
                 'father_phone' => $this->father_phone,
                 'father_nationality_id' => $this->father_nationality_id,
                 'father_blood_type_id' => $this->father_blood_type_id,
                 'father_religion_id' => $this->father_religion_id,
                 'father_address' => $this->father_address,
                 'mother_name' => [
                    'en' => $this->mother_name_ar,
                    'ar' => $this->mother_name_en,
                 ],
                 'mother_job' => [
                     'en' => $this->mother_job_ar,
                     'ar' => $this->mother_job_en,
                  ],
                  'mother_national_ID' => $this->mother_national_ID,
                  'mother_passport_ID' => $this->mother_passport_ID,
                  'mother_phone' => $this->mother_phone,
                  'mother_nationality_id' => $this->mother_nationality_id,
                  'mother_blood_type_id' => $this->mother_blood_type_id,
                  'mother_religion_id' => $this->mother_religion_id,
                  'mother_address' => $this->mother_address,

             ]);

             if(!empty($this->photos)) {
                foreach ($this->photos as $key => $photo) {
                    $path = Storage::putFile("attachments",$photo);
                    // $originalName = Input::file($path)->getClientOriginalName();
                    ParentAttachment::create([
                        'file_name' => $path,
                        'myparent_id' => Myparent::latest()->first()->id,
                    ]);
                };
            }



             $this->clearForm();
             $this->current_screen = 1;
             session()->flash("msg", "Information added successfully");
        }
        catch(Exception $e){
            session()->flash("error", "IProblem occured while adding information");
        }
    }


    public function clearForm()
    {
        $this->email = '';
        $this->password = '';
        $this->father_name_ar = '';
        $this->father_name_en = '';
        $this->father_job_ar = '';
        $this->father_job_en = '';
        $this->father_national_ID = '';
        $this->father_passport_ID = '';
        $this->father_phone = '';
        $this->father_nationality_id = '';
        $this->father_blood_type_id = '';
        $this->father_religion_id = '';
        $this->father_address = '';
        $this->mother_name_ar = '';
        $this->mother_name_en = '';
        $this->mother_job_ar = '';
        $this->mother_job_en = '';
        $this->mother_national_ID = '';
        $this->mother_passport_ID = '';
        $this->mother_phone = '';
        $this->mother_nationality_id = '';
        $this->mother_blood_type_id = '';
        $this->mother_religion_id = '';
        $this->mother_address = '';
        }

    public function render()
    {
        $nationalities = Nationality::all();
        $blood_types = Blood::all();
        $religions = Religion::all();

        return view('livewire.add-parent',['nationalities' => $nationalities,'blood_types' => $blood_types,'religions' => $religions]);
    }




}
