<?php

class photosFrontendErrorAction extends waViewAction
{
    public function execute()
    {
        $e = $this->getRequest()->param('exception');

        if ($e && ($e instanceof Exception) ) {
            /**
             * @var Exception $e
             */
            $code = $e->getCode();
            if (!$code) {
                $code = 500;
            }

            $message = $e->getMessage();
        } else {
            $code = 404;
            $message = _ws("Page not found");
        }
        $this->getResponse()->setStatus($code);
        $this->getResponse()->setTitle($code.'. '.$message);

        $this->view->assign('error_code', $code);
        $this->view->assign('error_message', $message);
        $this->setThemeTemplate('error.html', waRequest::param('theme', 'default'));
    }
}