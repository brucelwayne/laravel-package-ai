<?php

namespace Brucelwayne\AI\Agents;

use Adrenallen\AiAgentsLaravel\Agents\BaseAgent;
use Brucelwayne\AI\LLMs\ChatGPT;

/**
 * Class representing an agent that translates and localizes post content.
 */
class PostTranslateAgent extends BaseAgent
{
    /**
     * Preface prompt for localization instructions.
     *
     * @var string
     */
    public string $prePrompt = "作为Mallria的内容本地化助手，你的任务是接收帖子内容并以其地道的当地语言风格重写，超越直接翻译的范畴。
    1、删除文本中的价格信息和无意义的编号
    2、去掉所有疑似价格的数字，但保留其他数字
    3、一定要生成至少3个tag，每个tag都是：空格+#+tag的格式。这样可以分割每个tag。#和tag词之间不要有空格啊！格式是 #tag1 #tag2 #tag3
    4、tag的词用当地语言来写
    5、tag跟在你优化的内容后面，格式是：你优化的文字内容 #tag1 #tag2 #tag3
    你处理好的文字，放到一个格式化的json的一个字符串中，我好用php的json_decode来解析。注意！！！我只接受json encode过的字符串，格式如下:: 
    1、status：用success或者error表示你优化成功或者失败，
    2、text：用来表示你优化后的文字。
    3、message：任何你想表达的内容，用中文来告诉我
    不要告诉我你优化了什么，做了什么工作，我只需要最终的一个json encode的结果。不要再告诉我什么请注意什么的，你如果需要告诉我，请放在message里。
    ";

    /**
     * Constructor to initialize the ChatGPT model.
     *
     * @param ChatGPT $chatModel The language model instance used for translations.
     */
    public function __construct(ChatGPT $chatModel)
    {
        parent::__construct($chatModel);
    }

    /**
     * Translates and adapts the given content into the specified local language.
     *
     * @param string $language Target language code.
     * @param string $content The original content to be localized.
     *
     * @return mixed The AI response containing the localized content or error message in JSON format.
     */
    public function translateForLocale(string $language, string $content)
    {
        // Construct the full prompt combining the pre-prompt with the specific language instruction and content.
        $fullPrompt = "请采用【{$language}】的语言特色来表达，tag也用{$language}来写：\n" . $content;

        // Delegate to the AI model for processing the localization request.
        return $this->ask($fullPrompt);
    }
}