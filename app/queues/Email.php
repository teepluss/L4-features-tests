<?php

class Email {

    public function send($job, $data)
    {
        $data = array_merge(array('jobId' => $job->getJobId()), $data);

        Log::info('Q', $data);

        $job->delete();
    }

}