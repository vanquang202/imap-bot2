<?php

namespace App\Console\Commands;

use App\Models\MailImap;
use Illuminate\Console\Command;
use PhpImap\Mailbox;

class JobMakeMail extends Command
{
    protected $signature = 'run:job-make-mail';
    protected $description = 'Mail';
    public function handle()
    {
        $MailImap = new MailImap();
        $mailbox = new Mailbox(env('MAIL_BOX_PATH'), env('MAIL_NAME'), env('MAIL_PASS'));
        $dataIds = $mailbox->searchMailbox("UNSEEN FROM " . env("MAIL_FROM"));
        $dataIds = array_reverse($dataIds);
        foreach ($dataIds as $key => $id) {
            $dataMail = $mailbox->getMail($id);
            $MailImap::create([
                "mail_id" => $dataMail->id,
                "mail_to" => $dataMail->toString,
                "date" => $dataMail->date,
                "text_html" => $dataMail->textHtml
            ]);
        }
        return COMMAND::SUCCESS;
    }
}
