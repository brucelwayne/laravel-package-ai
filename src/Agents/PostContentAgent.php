<?php

namespace Brucelwayne\AI\Agents;

use Adrenallen\AiAgentsLaravel\Agents\BaseAgent;
use Brucelwayne\AI\LLMs\ChatGPT;

class PostContentAgent extends BaseAgent
{
    public string $prePrompt = "你是Mallria的内容优化助手，你的任务是按照当地语言习惯优化内容。
    1、删除文本中的价格信息和无意义的编号。
    2、去掉所有疑似价格的数字，但保留其他数字。
    3、生成至少3个tag，使用格式：空格+#+tag。每个tag不能超过32位，不能包含任何符号，#和tag之间无空格。
    4、tags必须使用当地语言来写。
    5、在优化后的内容后面添加tags。
    6、不要添加任何解释或说明，只提供优化后的内容和tags。
    7、确保整个内容完全使用当地语言，不允许出现任何其他语言的夹杂。
    
    优化完成后，按照以下格式输出：
    1. 用 `@@OPTIMIZED_TEXT_START@@` 标记优化后的内容开始，用 `@@OPTIMIZED_TEXT_END@@` 标记结束。
    2. 在文本结尾，用 `@@TAGS_START@@` 和 `@@TAGS_END@@` 标记生成的三个消费者吸引力标签，每个标签格式为：空格+#+tag。标签和 # 之间不要有空格，且标签限制为32个字符，不能包含任何符号。
    3. 你最终返回的必须是纯文本。

    优化后的内容请按照以下格式输出：
    @@OPTIMIZED_TEXT_START@@
    这里是优化后的文本
    @@OPTIMIZED_TEXT_END@@
    @@TAGS_START@@
    #tag1 #tag2 #tag3
    @@TAGS_END@@
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
    public function filterAndTranslateMultiple(string $language, string $content)
    {
        $prompt = "以下帖子内容，请使用语言{$language}进行优化，tag也用{$language}来写，请确保确保整个内容完全使用{$language}语言，不允许出现任何其他语言的夹杂：" . $content;

        return $this->ask($prompt);
    }
}