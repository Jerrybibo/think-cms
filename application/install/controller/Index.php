<?php
namespace app\install\controller;

use cms\Controller;
use app\manage\logic\ViewLogic;
use app\install\logic\InstallLogic;

class Index extends Controller
{

    protected $siteTitle;

    /**
     *
     * {@inheritdoc}
     *
     * @see Controller::_initialize()
     */
    protected function _initialize()
    {
        $this->checkInstall();
    }

    /**
     * 验证安装
     *
     * @return void
     */
    protected function checkInstall()
    {
        $databaseFile = InstallLogic::getSingleton()->getDatabaseFile();
        if (is_file($databaseFile)) {
            $this->success('安装完成');
        }
    }

    /**
     * 开始
     *
     * @return string
     */
    public function index()
    {
        $this->siteTitle = '开始使用';
        return $this->fetch();
    }

    /**
     * 安装
     *
     * @return void
     */
    public function install()
    {
        // 验证安装
        $this->checkInstall();
        
        try {
            InstallLogic::getSingleton()->doInstall();
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
        $this->success('安装成功', 'manage/start/login');
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see Controller::beforeViewRender()
     */
    protected function beforeViewRender()
    {
        // 网站标题
        $this->assign('site_title', $this->siteTitle);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see Controller::getView()
     */
    protected function getView()
    {
        return ViewLogic::getSingleton()->getView();
    }
}