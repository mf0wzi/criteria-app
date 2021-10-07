<?php

namespace App\Http\Livewire;

use App\Http\Override\HeadingRowImportEn;
use App\Http\Override\HeadingRowImportNew;
use App\Http\Imports\ExcelsImport;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Livewire\Component;
use App\Models\ExcelStore;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class ExcelStores extends Component
{
    use WithFileUploads;

    /**
     * @var string
     */
    public $confirmingActivation = false;
    public $actionActivation = false;
    public $groupActivation = false;
    public $ifActivation = false;
    public $name, $description, $excelFile;
    public $selectedFields;
    public $rowId, $rowUUID, $rowTableName, $viewType, $rowHeaderData;
    public static $headerArray, $headerEnJson, $texts;

    protected $listeners = ['openmodal','openGroupModal','openIfModal'];


    protected $rules = [
        'name' => 'required|min:6',
        'description' => 'required|string',
        'excelFile' => 'required|mimes:xlsx,xls,csv',
    ];

    public function render()
    {
        return view('livewire.excel-stores');
    }

    public function submit()
    {
        $this->validate();

        $table_name = 'excel_'.Str::random(5).'s';
        $headerJsonMix = $this->getExcelHeaderMix();
        static::makeDB($this->excelFile, $table_name);
        Excel::import(new ExcelsImport(self::$headerArray, $table_name), $this->excelFile);
        try {
            ExcelStore::create([
                'uuid' => $this->uuidGenerator(),
                'name' => $this->name,
                'description' => $this->description,
                'auto_generated_name' => $table_name,
                'excel_file_name' => 'excel_'.Str::random(20),
                'excel_file_path' => 'excel_'.Str::random(20),
                'excel_file_header' => $headerJsonMix,
            ]);
            $this->emit('refreshLivewireDatatable');
            $this->deactivate();
            $this->resetInputFields();
            $this->emit('saved');
            $this->alert('success', 'Excel Successfully Uploaded!!');
        } catch (Exception $e) {
            $this->alert('error', "Please try again later.");
        }
    }

    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    private function resetInputFields()
    {
        $this->name = '';
        $this->description = '';
        $this->excelFile = '';
    }

    public function getExcelHeaderMix()
    {
        $headings = (new HeadingRowImportNew)->toArray($this->excelFile);
        $headerJson = collect($headings)->toJson(JSON_UNESCAPED_UNICODE);
        return $headerJson;
    }

    public static function getExcelHeaderEn($file)
    {
        $headings = (new HeadingRowImportEn)->toArray($file);
        $headerJson = collect($headings)->toJson(JSON_UNESCAPED_UNICODE);
        return $headerJson;
    }

    public static function makeDB($file,$table_name)
    {

        $headingsEn = self::getExcelHeaderEn($file);
        static::$headerEnJson = collect($headingsEn)->toJson(JSON_UNESCAPED_UNICODE);

        Schema::create($table_name, function (Blueprint $table)
        {
            static::$texts = str_replace(str_split('\\["()/]'),'',static::$headerEnJson);
            $array = explode("," , static::$texts);
            self::$headerArray = $array;
            $table->increments('id');
            foreach($array as $column){
                $table->text($column)->nullable();
            }
            $table->string('table_name');
            $table->timestamps();
        });
    }

    public function selectionFilters()
    {

        $this->emitTo('selection-filters', 'submit');
    }

    public function activate()
    {
        $this->confirmingActivation = true;
    }

    public function deactivate()
    {
        $this->confirmingActivation = false;
    }

    public function openmodal($rowId, $rowUUID, $rowTableName, $viewType, $rowHeaderData)
    {
//        dd($rowId, $rowUUID, $rowTableName, $viewType, $rowHeaderData);
        $this->rowId = $rowId;
        $this->rowUUID = $rowUUID;
        $this->rowTableName = $rowTableName;
        $this->viewType = $viewType;
        $this->rowHeaderData = $rowHeaderData;
        $this->actionActivation = true;
//        if($viewType == 'viewIfForm'){
//            $this->openIfModal();
//        }
    }

    public function deactivateAction()
    {
        $this->emit('resetAll');
        $this->actionActivation = false;
    }

    public function openGroupModal()
    {
        $this->emitTo('selection-filter-groups', 'refreshComponent');
        $this->groupActivation = true;
    }

    public function deactivateGroupModal()
    {
        $this->groupActivation = false;
    }

    public function openIfModal()
    {
//        dd('here');
//        $this->emitTo('selection-if-parent-filter', 'refreshComponent');
        $this->ifActivation = true;
    }

    public function deactivateIfModal()
    {
        $this->ifActivation = false;
    }

    public function uuidGenerator(){
       return Str::uuid()->toString();
    }
}
