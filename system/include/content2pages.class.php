<?php
/********************************************************
*类名：content2page.class.php
*描述：用于自动生成新闻静态页，手动添加分页功能，自动生成页码
*作者：程相闯
*日期：2006-11-27 14：20
*联系：cxc-0378@163.com

使用示例：
$con2page = new Content2Page;
$con2page->FileName = "";  //生成静态文件名
$con2page->FileDir = "html/";  //生成静态页面存放的目录文件夹，若不为空则要在末尾加“/”
$con2page->TemplateName = "";  //模班文件名
$con2page->Content = "";  //新闻内容,一般用POST或GET传递
$con2page->Content2Html();
*******************************************************/
class Content2Page
{
var $FileName = "test";//生成静态页面的文件名，默认为test
var $FileDir = "";//生成静态页面存放的目录文件夹，若不为空则要在末尾加“/”
var $TemplateName = "template.html";//调用模班页面名称,默认为template.html
var $NewsPage = "";//新闻分页
var $Content = "";//新闻内容
var $SplitSymbol = "*分页符*";//内容分页符,默认为“*分页符*”
var $NowPage = "";//当前页面
var $CountPage = "";//总分页数

/*************************************************
   Function:      Content2Html()
   Descrīption:  用来将新闻内容分页输出
   Calls:        ReadFromFile(),Write2File(),GetPageCount()
   Input:        含分页符的新闻内容
   Output:       已经分页的HTML静态页面
   Return:     void
   Access：    public
*************************************************/
  function Content2Html()
  {
   $FileNameTemp = $this->FileName;
   if ($_POST['Submit'])
   {
    if($this->Content=="")
      {
        echo "请输入内容";
        exit;
      }
      $ContentTemp = explode($this->SplitSymbol, $this->Content);
      $this->CountPage = count($ContentTemp);
      //文件操作
      for($k = 0 ; $k <= $this->CountPage-1 ; $k++)
      {
        /*******判断页数，成生页码 BEGIN***********/
        if ($this->CountPage > 1)
        {
         //若不是单页新闻，需要显示分页信息
          if ($k == 0)
          {
           $this->NowPage = 1;      //当前页
           $this->NewsPage = $this->GetPageCount();
          }
         else
         {
            $this->NowPage = $k + 1;
            $this->NewsPage = $this->GetPageCount();
            $this->FileName = $this->FileName . "_" . $this->NowPage;
         }
       }
     /**************生成页码 END *************/
     //将内容写入模班
        $read=$this->ReadFromFile($this->TemplateName);
        $read=str_replace("{Content}",$ContentTemp[$k],$read);
        $read=str_replace("{NewsPage}",$this->NewsPage,$read);
        $this->Write2File($read,$this->FileDir.$this->FileName . ".html");
        $this->FileName = $FileNameTemp;//初始化文件名
      }
  }
  }
  /****************************************
   Function:          ReadFromFile()
   Parameter：  $name 文件名
   Descrīption:      用来读取文件内容
   Called By:         Content2Html()
   Input:               文件名
   Output:            找到文件，读取起内容
   Return:     $read 内容字符串
   Access：    public
*****************************************/  
  function ReadFromFile($name)
{
    $f=@file($name);
    if($f)
    {
      foreach($f as $in)
       {
         $read.=$in;
       }
    }
    return $read;
}
/******************************************
   Function:        Write2File()
   Parameter：   $content 待写入的内容
          $file 要写入的文件
   Descrīption:    用来写入文件内容
   Called By:       content2html()
   Return:      void
   Access：     public                                          
*******************************************/  
function Write2File($content,$file)
{
    $fp=@fopen($file,"w");
    @fputs($fp,$content);
    @fclose($file);
}

/********************************************
   Function:        GetPageCount()
   Descrīption:    分几种情况输出页面分页的格式
   Calls:     GetColor()
   Called By:       Content2Html()
   Return:      $GetPageCount 自动分页字符串
   Access：     public
********************************************/  
function GetPageCount()
{
  //自动生成页码
  //==========显示结果============
  //上一页 1 2 3 下一页
  //上一页 ... 4 5 6 下一页
  //上一页 1 2 3 ... 下一页
  //上一页 ... 4 5 6 ... 下一页
  //==============================
  $ShowPageNum = 7; //最好是单数，好看一些 ... 11 12 13 <14> 15 16 17 ...
  $PageUp = "";
  $PageDown = "";
  $GetPageCount = "";
   if($this->NowPage == 1)
   {
      $GetPageCount = $GetPageCount . "<a href='" . $this->FileName . ".html'><font color='#ff0000'><b>1</b></font></a> ";
   }
   else
   {
      $GetPageCount = $GetPageCount . "<a href='" . $this->FileName . ".html'>1</a> ";
   }
     
   if($this->CountPage <= $ShowPageNum)
   {
     for ($i = 2; $i <= $this->CountPage; $i++)
     {
       $GetPageCount = $GetPageCount . "<a href='" . $this->FileName . "_" . $i . ".html'>" . $this->GetColor($i) . "</a> ";
     }
   }
   else
   {  
     //页数大于自定义的显示页码数量
      if ((($this->NowPage - 3) > 1) && (($this->NowPage + 3) < $this->CountPage))
      {
        $GetPageCount = "... ";
        for ($i = $this->NowPage - 3; $i <= $this->NowPage + 3; $i++)
        {
          $GetPageCount = $GetPageCount . "<a href='" . $this->FileName . "_" . $i . ".html'>" . $this->GetColor($i) . "</a> ";
        }
        $GetPageCount = $GetPageCount . "...";
      }
      else
      {
        if ((($this->NowPage - 3) > 1) && (($this->NowPage + 3) >= $this->CountPage))
        {
          $GetPageCount = "... ";
          for ($i = $this->CountPage - $ShowPageNum+1; $i <= $this->CountPage; $i++)
          {
           $GetPageCount = $GetPageCount . "<a href='" . $this->FileName . "_" . $i . ".html'>" . $this->GetColor($i) . "</a> ";
          }
        }
        else
        {
          for ($i = 2; $i <= $ShowPageNum; $i++)
          {
           $GetPageCount = $GetPageCount . "<a href='" . $this->FileName . "_" . $i . ".html'>" . $this->GetColor($i) . "</a> ";
          }
          $GetPageCount = $GetPageCount . "...";
        }
      }
   }
   //加首头页尾
   if($this->NowPage > 1)
   {
      if($this->NowPage > 2)
      {
        $PageUp = "<a href='" . $this->FileName . "_" . ($this->NowPage - 1) . ".html'>上页</a> ";
      }
      else
      {
        $PageUp = "<a href='" . $this->FileName . ".html'>上页</a> ";
      }
   }
  
   if ($this->NowPage < $this->CountPage)
   {
     $PageDown = "<a href='" . $this->FileName . "_" . ($this->NowPage + 1) . ".html'>下页</a> ";
   }
   $GetPageCount = "<a href='" . $this->FileName . ".html'>首页</a>  " . $PageUp . $GetPageCount . $PageDown . "<a href='" . $this->FileName . "_" . $this->CountPage . ".html'>末页</a>";
   return $GetPageCount;
}

/*******************************************
   Function:        GetColor()
   Parameter：   $i 用来传递当前页面数
   Descrīption:    给当前页面标志醒目的颜色
   Called By:       GetPageCount()
   Return:      $GetColor 含当前页的字符串
   Access：     public
********************************************/  
function GetColor($i)
{     
   //当前页标志色
    if($i == $this->NowPage)
    {
       $GetColor = "<font color='#ff0000'><b>" . $this->NowPage . "</b></font>";
    }
    else
    {
       $GetColor = $i;
    }
      return $GetColor;
}
}//end of class
?>