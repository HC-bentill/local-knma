

<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gen_pdf extends CI_Controller {
    
    
    public function __construct() {
        parent::__construct();
    }

    public function send_mail($email, $copy, $attachment, $subject, $message) {
        $this->load->library("phpmailer_library");
        $mail = $this->phpmailer_library->load();

        //$mail = new PHPMailer;
        $mail->IsHTML();



        //$mail->SMTPDebug = 3;                               // Enable verbose debug output

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'ucmail.unicreditghana.com;192.168.0.100';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'ucglhq\unicreditgh';                 // SMTP username
        $mail->Password = '1234567.k';                           // SMTP password
        //$mail->SMTPSecure = 'tsl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;                                    // TCP port to connect to

        $mail->setFrom('unicreditgh@unicreditghana.com', 'uniCredit ERP');
        $b = explode(',', $email);
        for ($ii = 0; $ii < sizeof($b); $ii++) {
            $mail->addAddress($b[$ii]);
            //  $mail->addAddress($b[$ii]);
        }


        // $mail->addAddress($email, 'Joe User');     // Add a recipient
        // $mail->addAddress($email);               // Name is optional
        $mail->addReplyTo('unicreditgh@unicreditghana.com', 'Information');
        $bb = explode(',', $copy);
        for ($i = 0; $i < sizeof($bb); $i++) {
            $mail->addCC($bb[$i]);
            // $mail->addBCC($bb[$i]);
        }
        $mail->addCC($copy);
        $mail->addBCC($copy);

        $mail->addAttachment($attachment, 'E-Statement');         // Add attachments
        //  $mail->addAttachment($attachment);    // Optional name
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->AltBody = $message;

        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message sent';
        }
    }

    public function index() {

//        //load mPDF library
        $this->load->library('m_pdf');



        //load the view and saved it into $html variable
        $data = array(
            'logo' => base_url('assets/gif/uni1.jpg')
        );

        $html = $this->load->view('pages/email_template/certificate', $data, true);

        //this the the PDF filename that user will get to download
        $pdfFilePath = "output_pdf_name.pdf";



        //generate the PDF from the given html
        $attc = $this->m_pdf->pdf->WriteHTML($html);


        //exit($html);
        //download it.
        //-$this->m_pdf->pdf->Output($pdfFilePath, "D");
        ///////////

        $this->load->library("phpmailer_library");
        $mail = $this->phpmailer_library->load();

        //$mail = new PHPMailer;
        $mail->IsHTML();

        $email = 'eaccomford@gmail.com';
        $copy = '';
        $attachment = $attc;
        $subject = 'Testing email';
        $message = 'The email test finally worked so i have test attaching pdf and stuff to it.';


        //$mail->SMTPDebug = 3;                               // Enable verbose debug output

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'ucmail.unicreditghana.com;192.168.0.100';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'ucglhq\unicreditgh';                 // SMTP username
        $mail->Password = '1234567.k';                           // SMTP password
        //$mail->SMTPSecure = 'tsl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;                                    // TCP port to connect to

        $mail->setFrom('unicreditgh@unicreditghana.com', 'uniCredit ERP');
        $b = explode(',', $email);
        for ($ii = 0; $ii < sizeof($b); $ii++) {
            $mail->addAddress($b[$ii]);
            //  $mail->addAddress($b[$ii]);
        }


        // $mail->addAddress($email, 'Joe User');     // Add a recipient
        // $mail->addAddress($email);               // Name is optional
        $mail->addReplyTo('unicreditgh@unicreditghana.com', 'Information');
        $bb = explode(',', $copy);
        for ($i = 0; $i < sizeof($bb); $i++) {
            $mail->addCC($bb[$i]);
            // $mail->addBCC($bb[$i]);
        }
        $mail->addCC($copy);
        $mail->addBCC($copy);

        $mail->addAttachment($attachment, 'E-Statement');         // Add attachments
        //  $mail->addAttachment($attachment);    // Optional name
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->AltBody = $message;

        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message sent';
        }



        ///////////////
    }

    // display certificate
    public function get_certificate($id) {
        $query = "SELECT c.id,c.time,r.title, v.firstName,v.lastName FROM `exam_certificates` c"
                . " join exam_test e on e.course=c.course_id"
                . " join exam_courses r on r.id=e.course"
                . " join employee_view_active  v on v.employeeId = c.cert_holder "
                . " where c.id = $id";
        $data = array(
            'logo' => base_url('assets/gif/uni1.jpg'),
            'cert' => $this->db->query($query)->row_array()
        );

        $html = $this->load->view('pages/email_template/certificate', $data);

        echo json_encode($html);
    }

    public function sendmail() {
        mail('eaccomford@gmail.com', 'test', 'message', 'from: cc@bb.com');
    }
    
    
    
    
    
     
    

}
