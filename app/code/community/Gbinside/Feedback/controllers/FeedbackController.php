<?php

/**
 * Created by PhpStorm.
 * User: Roberto
 */
class Gbinside_Feedback_FeedbackController extends Mage_Core_Controller_Front_Action
{
    public function postAction()
    {
        $var = json_decode($this->getRequest()->getParam('data'), true);
        if (!empty($var)) {
            $issue = Mage::getModel('gbfeedback/feedback')
                ->setIssue($var[0]['Issue'])
                ->setImage($var[1])
                ->save();

            if (Mage::getStoreConfigFlag('system/smtp/disable')) {
                return;
            }

            $problema_segnalato = $this->__('Issue reported');

            $mail = Mage::getModel('core/email')
                ->setType('html')
                ->setBody(
                    "<h2>$problema_segnalato {$issue->getId()}</h2>\r\n\r\n<pre>" . $issue->getIssue() . "</pre>\r\n"
                )
                ->setToName(Mage::getStoreConfig('contacts/email/sender_email_identity'))
                ->setToEmail(Mage::getStoreConfig('contacts/email/recipient_email'))
                ->setSubject($problema_segnalato)
                ->setFromEmail(Mage::getStoreConfig('contacts/email/recipient_email'))
                ->setFromName($problema_segnalato);

            try {
                $mail2 = new Zend_Mail();

                if (strtolower($mail->getType()) == 'html') {
                    $mail2->setBodyHtml($mail->getBody());
                } else {
                    $mail2->setBodyText($mail->getBody());
                }

                $mail2->setFrom($mail->getFromEmail(), $mail->getFromName())
                    ->addTo($mail->getToEmail(), $mail->getToName())
                    ->setSubject($mail->getSubject());

                $mail2->createAttachment(
                    base64_decode(substr($issue->getImage(), strlen('data:image/png;base64,'))),
                    'image/png',
                    Zend_Mime::DISPOSITION_ATTACHMENT,
                    Zend_Mime::ENCODING_BASE64,
                    'issue.png'
                );

                $mail2->send();
            } catch (Exception $error) {
                print_r($error);
            }
        }
    }
}