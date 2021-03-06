<?php
use think\migration\Migrator;
use think\migration\db\Column;

class CreateTableManageUser extends Migrator
{

    /**
     * 返回数据表
     *
     * @return \think\migration\db\Table
     */
    public function getTable()
    {
        return $this->table('manage_user');
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Phinx\Migration\AbstractMigration::up()
     */
    public function up()
    {
        $table = $this->getTable();
        
        // 用户名
        $userName = Column::string('user_name', 16)->setComment('用户名');
        $table->addColumn($userName);
        
        // 密码
        $userPasswd = Column::string('user_passwd', 32)->setComment('密码');
        $table->addColumn($userPasswd);
        
        // 昵称
        $userNick = Column::string('user_nick', 150)->setDefault('')->setComment('昵称');
        $table->addColumn($userNick);
        
        // 分组ID
        $groupId = Column::integer('group_id')->setComment('分组ID');
        $table->addColumn($groupId);
        
        // 状态
        $userStatus = Column::integer('user_status')->setLimit(4)
            ->setDefault(0)
            ->setComment('用户状态');
        $table->addColumn($userStatus);
        
        // 登录时间
        $loginTime = Column::integer('login_time')->setDefault(0)->setComment('登录时间');
        $table->addColumn($loginTime);
        
        // 登录IP
        $loginIp = Column::string('login_ip', 20)->setDefault('')->setComment('登录IP');
        $table->addColumn($loginIp);
        
        // 登录次数
        $loginCount = Column::integer('login_count')->setDefault(0)->setComment('登录次数');
        $table->addColumn($loginCount);
        
        // 创建时间
        $createTime = Column::integer('create_time')->setDefault(0)->setComment('创建时间');
        $table->addColumn($createTime);
        
        // 更新时间
        $updateTime = Column::integer('update_time')->setDefault(0)->setComment('更新时间');
        $table->addColumn($updateTime);
        
        // 用户名，唯一索引
        $table->addIndex('user_name', [
            'unique' => true
        ]);
        
        // 保存
        $table->save();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Phinx\Migration\AbstractMigration::down()
     */
    public function down()
    {
        $this->getTable()->drop();
    }
}
