<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Topic;

class TopicFormFields extends Job
{
    protected $id;

    protected $fieldList = [
        'name' => '',
        'college' => '',
        'grade' => '',
        'content' => '',
        'type' => '',
        'place' => '',
        'week' => '',
        'number' => '',
        'level' => '',
        'requirement' => '',
        'profile' => '',
    ];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id = null)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $fields = $this->fieldList;

        if ($this->id) {
            $fields = $this->topicFromModel($this->id, $fields);
        }

        return $fields;
    }

    protected function topicFromModel($id, array $fields)
    {
        $fields = Topic::find($id);

        return $fields;
    }
}
