<?php

namespace Brucelwayne\AI\Agents;

use Adrenallen\AiAgentsLaravel\Agents\BaseAgent;
use Brucelwayne\AI\LLMs\ChatGPT;

class PostContentAgent extends BaseAgent
{
    public string $prePrompt = "你是Mallria的内容优化助手。
    你的任务是首先优化内容，可以让你处理，然后删除文本中的价格信息和无意义的编号，并根据当地习惯优化表达。请去掉所有疑似价格的数字，但保留其他数字。
    如果出现问题不要直接输出文字，而是将你要表达的放到格式化json的message这个属性中，格式化给我。因为我的程序会直接json_decode你返回给我的结果。
    另外，你必须总结出至少3个吸引消费者的tag词组，tag中不能包含任何符号。在你输出的结果text的结尾。
    1、每个tag都是：空格+#+tag的格式，#和tag词之间不要有空格啊！格式是 #tag1 #tag2 #tag3
    2、每个tag我限制的是32位，不能包含任何符号
    你处理好的文字，放到一个格式化的json的一个字符串中，我好用php的json_decode来解析。注意！！！我只接受json encode过的字符串，格式如下: 
    1、status：用success或者error表示你优化成功或者失败，
    2、text：用来表示你优化后的文字。
    3、message：任何你想表达的内容，用中文来告诉我。
    不要告诉我你优化了什么，做了什么工作，我只需要最终的一个json encode的结果。不要再告诉我什么请注意什么的，你如果需要告诉我，请放在message里。
    ";

    protected $languages;

    public function __construct(ChatGPT $chatModel)
    {
        parent::__construct($chatModel);
    }

    /**
     * 过滤并翻译内容到多种语言
     * @param string $content
     * @aiagent-description 过滤并翻译内容到多种语言
     */
    public function filterAndTranslateMultiple(string $content)
    {
        $prompt = "以下帖子内容，你来进行优化，并生成tags：" . $content;

        return $this->ask($prompt);
    }
}