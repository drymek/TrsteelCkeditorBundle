<?php

namespace Trsteel\CkeditorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;

class UploadController extends Controller
{
    
    public function indexAction()
    {
        $request = $this->getRequest();

        $field_name = $request->get('CKEditor');
        
        $path = $this->container->getParameter('trsteel_ckeditor.path');

        $web = $path['web'];
        $upload = $path['upload'];


        $file = $request->files->get('upload');
        $filename = $this->getRandomFilename($file);

        $file->move($upload, $filename);

        return $this->render('TrsteelCkeditorBundle:Upload:index.html.twig', array(
            'CKEditorFuncNum' => $request->get('CKEditorFuncNum'),
            'web_path' => $web,
            'filename' => $filename,
        ));
    }

    protected function getRandomFilename(UploadedFile $file)
    {
        return uniqid().'_'.$file->getClientOriginalName();
    }
}
