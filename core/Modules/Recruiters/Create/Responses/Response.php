<?php

namespace Recruitment\Modules\Recruiters\Create\Responses;

use Recruitment\Modules\Recruiters\Create\Entities\Recruiter;
use Recruitment\Modules\Recruiters\Create\Presenters\Responses\ResponsePresenter;

class Response
{
    private $status;
    private $recruiter;

    public function __construct(Status $status, Recruiter $recruiter)
    {
        $this->status = $status;
        $this->recruiter = $recruiter;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function getRecruiter(): Recruiter
    {
        return $this->recruiter;
    }

    public function getPresenter(): ResponsePresenter
    {
        return (new ResponsePresenter($this))->present();
    }
}
