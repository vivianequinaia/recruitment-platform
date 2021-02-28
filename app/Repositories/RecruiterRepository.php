<?php

namespace App\Repositories;

use App\Models\Recruiter;
use Recruitment\Modules\Recruiters\Create\Exceptions\CpfAlreadyExistsException;
use Recruitment\Modules\Recruiters\Create\Exceptions\CreateRecruiterException;
use Recruitment\Modules\Recruiters\Create\Gateways\CreateRecruiterGateway;
use Recruitment\Modules\Recruiters\Create\Requests\Request;
use Recruitment\Modules\Recruiters\Create\Entities\Recruiter as CreateRecruiter;

class RecruiterRepository implements CreateRecruiterGateway
{
    private $model = Recruiter::class;

    public function create(Request $request): CreateRecruiter
    {
        try {
            $recruiter = $this->model::where('cpf', $request->getCpf())->first();
        } catch (\Exception $exception) {
            throw new CreateRecruiterException($exception->getMessage(), $exception->getCode(), $exception);
        }

        if (!is_null($recruiter)) {
            throw new CpfAlreadyExistsException('This CPF is already in use.', 400);
        }

        try {
            $recruiter = $this->model::firstOrCreate(
                [
                    'name' => $request->getName(),
                    'cpf' => $request->getCpf(),
                    'email' => $request->getEmail(),
                    'password' => $request->getPassword(),
                    'company_id' => $request->getCompanyId()
                ]
            );

            return new CreateRecruiter(
                $recruiter->name,
                $recruiter->cpf,
                $recruiter->password,
                $recruiter->email,
                $recruiter->company_id
            );
        } catch (\Exception $exception) {
            throw new CreateRecruiterException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }
}
