<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\services;

use yii\db\Query;
use app\modules\app433\models\Post;

class SiteService {

    public function getPostShort433(){
         $query = new Query;
        $query	->select([
                        'a.Title', 
                        'a.Thumbnails',
                        'a.Content',
                        'a.ContentNone',
                        'a.DateCreate',
                        'a.Summary',
                        'b.FullName',
                        'c.CategoryName',
                        'c.Logo'
                        ]
                        )  
                ->from('Post as a')
                ->where(['a.Public'=>1])
                ->andWhere(['a.Type'=>0])
                ->leftJoin('Admin_Cms as b', 'a.UserCreate = b.ID')		
                ->leftJoin('Categories as c', 'a.CategoryID = c.CategoryID')
                ->orderBy("a.ID DESC")
                ->LIMIT(5); 

        $command = $query->createCommand(\app\modules\app433\models\Post::getDb());
        $data = $command->queryAll();	
        
        return $data;
    }
    
    public function getPostLong433(){
        $query = new Query;
        $query	->select([
                        'a.Title', 
                        'a.Thumbnails',
                        'a.Content',
                        'a.DateCreate',
                        'a.Summary',
                        'b.FullName',
                        'c.CategoryName',
                        'c.Logo'
                        ]
                        )  
                ->from('Post as a')
                ->where(['a.Public'=>1])
                ->andWhere(['a.Type'=>4])
                ->leftJoin('Admin_Cms as b', 'a.UserCreate = b.ID')		
                ->leftJoin('Categories as c', 'a.CategoryID = c.CategoryID')
                ->orderBy("a.ID DESC")
                ->LIMIT(5); 

        $command = $query->createCommand(\app\modules\app433\models\Post::getDb());
        $data = $command->queryAll();	
        
        return $data;
    }
    
    public function getVideo433(){
        $query = new Query;
        $query	->select([
                        'a.Title', 
                        'a.Thumbnails',
                        'a.Content',
                        'a.DateCreate',
                        'a.ThumbVideo',
                        'a.Summary',
                        'b.FullName',
                        'c.CategoryName',
                        'c.Logo'
                        ]
                        )  
                ->from('Post as a')
                ->where(['a.Public'=>1])
                ->andWhere(['a.Type'=>1])
                ->leftJoin('Admin_Cms as b', 'a.UserCreate = b.ID')		
                ->leftJoin('Categories as c', 'a.CategoryID = c.CategoryID')
                ->orderBy("a.ID DESC")
                ->LIMIT(5); 

        $command = $query->createCommand(\app\modules\app433\models\Post::getDb());
        $data = $command->queryAll();	
        
        return $data;
    }
    
    public function getNews90phut(){
        
        $query = new Query;
        $query	->select([
                        'a.Title', 
                        'a.Thumbnails',
                        'a.ReleaseDate',
                        'a.Summary',
                        'b.FullName',
                        'c.CategoryName'
                        ]
                        )  
                ->from('News as a')
                ->where('ExtendIsPublic=1')
                ->leftJoin('Extend_User as b', 'a.ExtendUserCreate = b.ID')		
                ->leftJoin('Category as c', 'a.CategoryID = c.CategoryID')
                ->orderBy("a.ID DESC")
                ->LIMIT(5); 
        
        $command = $query->createCommand(\app\modules\app90phut\models\News::getDb());
        $data = $command->queryAll();	
        
        return $data;
    }
    
    public function getVideo90phut(){
        $query = new Query;
        $query	->select([
                        'a.EventName', 
                        'a.Avatar',
                        'a.DateCreate',
                        'b.FullName',
                        ]
                        )  
                ->from('Extend_Video as a')
                ->leftJoin('Extend_User as b', 'a.UserID = b.ID')		
//                ->leftJoin('Extend_Category_Video as c', 'a.LeagueID = c.LeagueID')
                ->orderBy("a.ID DESC")
                ->LIMIT(5); 

        $command = $query->createCommand(\app\modules\app90phut\models\News::getDb());
        $data = $command->queryAll();	
        
        return $data;
        
    }
    
    public function getTips90phut(){
         $query = new Query;
        $query	->select([
                        'a.Description', 
                        'a.CreateDate',
                        'b.FullName',
                        'c.AwayName',
                        'c.HomeName',
                        'c.MatchState',
                        'c.AwayID',
                        'c.HomeID'                      
                        ]
                        )  
                ->from('Extend_Match_Tips as a')
                ->leftJoin('Extend_User as b', 'a.UserCreate = b.ID')		
                ->leftJoin('Soccer_Match_Info as c', 'a.MatchID = c.MatchID')
                ->orderBy("a.CreateDate DESC")
                ->LIMIT(5); 

        $command = $query->createCommand(\app\modules\app90phut\models\News::getDb());
        $data = $command->queryAll();	
        
        return $data;
        
    }


    public function getAllData(){
        $data = array();
        $data["433_post_short"] = $this->getPostShort433();
        $data["433_post_long"] = $this->getPostLong433();
        $data["433_video"] = $this->getVideo433();
        $data["90phut_news"] = $this->getNews90phut();
        $data["90phut_video"] = $this->getVideo90phut();
        $data["90phut_tips"] = $this->getTips90phut();

        return $data;
    }
}
