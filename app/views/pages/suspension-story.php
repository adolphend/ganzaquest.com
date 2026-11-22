<?php
if ($LANG !== 'en') {
    render('partials/suspension-translation', ['suspension' => $suspension, 'suspensionUI' => $suspensionUI]);
    return;
}
?>
<nav class="story-breadcrumb" aria-label="Breadcrumb">
<a href="<?= e(url('home')) ?>">Home</a><span>/</span>
<a href="<?= e(url('blog')) ?>">Blog</a><span>/</span>
<span aria-current="page">What Would You Ask It to Do?</span></nav>
<article class="door-story suspension-story" lang="en">
<header class="story-hero">
<div class="story-hero-copy"><p class="eyebrow">AI agents in everyday engineering</p>
<h1>What Would You<br>Ask It to Do?</h1>
<p class="standfirst">A speed bump, a gentler ride, and a different way to put AI to work.</p>
<p class="story-meta">A GanzaQuest engineering case study · 8-minute read</p>
<a class="read-link" href="#bump">Start with the bump</a></div>
<figure class="story-illustration"><img src="<?= e(asset('img/suspension-model.svg')) ?>" width="800" height="600" fetchpriority="high" alt="A simplified model of one corner of a car: the body connects through a spring and damper to a wheel above the road."><figcaption>One corner of a car. Enough to begin an investigation.</figcaption></figure>
</header>
<div class="story-body">
<section id="bump" class="story-chapter">
<h2>The bump you already know</h2>
<p>You see it ahead and slow down. The front wheels climb the speed bump. You feel a jolt through the seat, then the car rises and falls before settling.</p>
<p>Suppose you could change the suspension. Would a softer spring make that moment gentler? Would the car stop bouncing sooner, or keep moving for longer?</p>
<p>It is an everyday experience with an engineering investigation underneath it. To answer, someone has to build a model, choose what to measure, try different settings, and work out what the results mean.</p>
<p>I gave that investigation to an AI agent. The project was called SuspensionLab AI, and the brief asked Codex to work with MATLAB and Simulink to explore a better suspension setting.</p>
<p>Before getting to the tools, though, there was a question worth settling.</p>
</section>
<aside class="decision" aria-labelledby="decision-title"><p class="eyebrow">A moment to decide</p><h2 id="decision-title">What would make the ride better?</h2><p>Open a possibility. There is no score.</p>
<details><summary>A gentler jolt</summary><p>That is a useful goal. Measuring body acceleration gives us one way to compare designs. We should also check what happens after the initial disturbance.</p></details>
<details><summary>Less time bouncing afterward</summary><p>That matters too. A setting that reduces acceleration can still take longer to settle. We need to record both before choosing.</p></details>
<details><summary>Good behavior on other roads</summary><p>A design selected using one set of road inputs deserves a fresh test. We can set aside different conditions and use them only after choosing the parameters.</p></details>
</aside>
<section class="story-chapter" id="assignment"><h2>The assignment behind the answer</h2>
<p>The brief included instructions for how the agent should work. Inspect the environment. Check that the software is available. Test the model before experimenting. Save the settings and results. Keep a record when something fails.</p>
<p>It also required a comparison between MATLAB and Simulink, and a final test on roads that had not been used to choose the suspension.</p>
<p>Those instructions turn a broad ambition into work that can be examined. If the result looks promising, there should be a record of the model, inputs, calculations, and checks behind it. If something goes wrong, there should be enough information to investigate.</p>
<p>For someone who uses simulation every day, this is familiar territory. You change a parameter, run the model, inspect a plot, and wonder whether an unexpected curve comes from the physics or a mistake. You check the initial conditions, look at the equations, adjust a solver setting, and run it again.</p>
<p>The possibility I wanted to explore was an agent carrying out that sequence, following an engineering brief.</p></section>
<section class="story-chapter" id="tools"><h2>First, can it reach the laboratory?</h2>
<p>Codex coordinated the work. MATLAB performed the calculations, and Simulink provided another implementation of the model. To move between them, the agent needed a working connection to the software.</p>
<p>That connection used <strong>MCP, short for Model Context Protocol</strong>. Think of a colleague asking a program to run a calculation and receiving the result. MCP gives an agent and a tool server a common way to exchange those requests and responses.</p>
<p>The recorded connection checks were deliberately small: add two numbers in MATLAB, solve a numerical problem, then save a value and read it back. Simple operations established that the agent could actually use the intended tool.</p>
<p>The terminology becomes easier here. The <strong>agent</strong> coordinates the steps. A <strong>tool</strong> performs an available action, such as running MATLAB code. A <strong>skill</strong> provides reusable instructions for a type of task. The project brief adds the particular goals and rules for this investigation.</p>
<p>Giving the agent an engineering role is only a starting point. The workflow also has to specify what it should check before accepting a result.</p></section>
<section class="story-chapter" id="model"><h2>A small piece of a car</h2>
<p>The agent built a quarter-car model: one portion of the body, one wheel assembly, a suspension spring and damper, and a tire represented by its stiffness. The road moves beneath the wheel, and the equations describe how the wheel and body respond.</p>
<p>This is a deliberately simplified view. It gives us a manageable way to study the question without representing every part of a vehicle.</p>
<p>The saved checks cover equilibrium, energy balance, and the sensitivity of the results to numerical integration settings. The agent also compared the MATLAB and Simulink implementations using the same road inputs.</p>
<p>There were mistakes along the way. One tool request omitted a required argument. Another used the wrong parameter name while configuring a Simulink block. The recovery records describe inspecting the available information, correcting the calls, and checking again.</p>
<p>That is part of the job. An engineering workflow needs a way to investigate a failure and retain what happened.</p></section>
<section class="story-chapter" id="search"><h2>Give it a road. Then another.</h2>
<p>The baseline suspension ran over three simulated surfaces: a nearly smooth road, a single bump, and a rough road. For each one, the experiment recorded body acceleration, suspension travel, and wheel response.</p>
<p>Then MATLAB's Optimization Toolbox searched for spring and damper settings within specified bounds. Codex coordinated the workflow; MATLAB's <code>fmincon</code> solver, using its SQP algorithm, performed the numerical search.</p>
<p>The search evaluated <strong>56 configurations</strong> within a budget of 60. It sought lower body acceleration while respecting limits on suspension travel and minimum wheel load. This was a bounded numerical search, with a possible local minimum reported by the solver.</p>
<p>Once a setting had been selected, it faced a different bump and a different rough-road profile. Both the baseline and the selected suspension experienced those same new inputs.</p></section>
<section class="story-chapter" id="result"><h2>A gentler ride. A longer bounce.</h2>
<p>On the new bump, the selected suspension reduced body RMS acceleration by about <strong>45%</strong>. On the new rough road, the reduction was about <strong>28%</strong>. RMS acceleration measures the overall magnitude of acceleration during the simulated interval; the project used it as an indicator of comfort.</p>
<p>But another number belonged beside those improvements. After the new bump, the baseline body settled in roughly <strong>2.8 seconds</strong>. The selected setting took about <strong>4 seconds</strong>, using the experiment's settling criterion.</p>
<p>The acceleration was lower. The motion took longer to settle.</p>
<figure class="suspension-result"><a href="<?= e(asset('img/suspension-holdout.png')) ?>"><img src="<?= e(asset('img/suspension-holdout.png')) ?>" loading="lazy" alt="Saved comparison plot for the independent bump test, showing baseline and selected suspension responses."></a><figcaption>Saved output from the independent bump comparison. Open the image for a larger view.</figcaption></figure>
<p>Now return to the choice at the beginning. Would you accept a gentler disturbance if the body kept moving for longer? That depends on what you are designing for. The result gives an engineer a trade-off to judge.</p>
<p>The selected configuration remained within the specified travel and minimum-load limits in both independent tests. On the rough road, however, it used more suspension travel and reached a lower minimum wheel load than the baseline. Passing a limit does not mean every measure improved.</p>
<p>These findings describe a simplified simulation. Establishing how an actual vehicle would behave would require further modeling and physical testing.</p>
</section>
<aside class="decision" aria-labelledby="review-title"><p class="eyebrow">Your turn to review</p><h2 id="review-title">Would you accept the result?</h2><details><summary>What would you check before choosing the setting?</summary><p>Look at the trade-offs as well as the acceleration reduction. Check the road inputs, model assumptions, settling criterion, suspension travel, and wheel load. Ask whether the separate test conditions are representative of the intended use. A clear improvement in one metric is useful evidence, but the design decision still needs judgment.</p></details></aside>
<section class="story-chapter" id="work"><h2>The skill is in shaping the work</h2>
<p>For me, the most interesting outcome is the sequence behind the numbers. The agent used engineering software, checked model behavior, coordinated a numerical search, and brought back results from separate test conditions.</p>
<p>That sequence spans tasks associated with modeling, numerical analysis, testing, and reporting. An agent can help carry work across those roles when it has suitable tools and clear instructions.</p>
<p>Imagine this in the daily work of someone who already knows MATLAB and simulation well. An agent could prepare a comparison, run a set of scenarios, investigate a tool error, and organize the evidence. The engineer's expertise would shape the assignment and determine what conclusions the results support.</p>
<p>That makes designing the workflow a valuable skill in its own right. What should the agent measure? Which constraints matter? What would reveal a mistake? Which test should be kept separate from the search? What must be saved so someone else can follow the work?</p>
<p>The better we can answer those questions, the more useful work we can ask an agent to undertake.</p>
<p>We started with a bump in the road. Think now about a task you repeat at your own desk: the tools you open, the checks you perform, and the evidence you need before making a decision. There may be an investigation there that an agent could help you carry out.</p></section>
<footer class="story-ending"><p class="eyebrow">A question to take with you</p><p>What would you ask it to do?</p><p>And how would you know it had done the work well?</p><a href="#bump">Return to the story</a></footer>
<section class="story-chapter suspension-notes" aria-labelledby="evidence-title"><h2 id="evidence-title">Explore the experiment</h2>
<p>The SuspensionLab AI simulations were run specifically for this article. The project records include source files, experiment settings, comparison plots, and recovery logs. The investigation used MATLAB R2024a and MATLAB MCP Server 0.16.1, connected to Codex through its native MATLAB MCP connection. The figures presented here come from the supplied project records.</p>
<p><a href="<?= e(asset('data/suspension-evidence.json')) ?>">Read the numerical evidence and experiment settings (JSON)</a>. The baseline used spring stiffness of 16,000 N/m and damping of 1,000 N·s/m; the selected values were 8,000 N/m and approximately 594 N·s/m. The selected spring stiffness reached the search's lower bound, so this is a result within the chosen design space, not proof of a universal best setting.</p>
<p>Explore the official MathWorks projects: <a href="https://github.com/matlab/agentic-toolkit-installer">Agentic Toolkit Installer</a>, <a href="https://github.com/matlab/matlab-mcp-server">MATLAB MCP Server</a>, <a href="https://github.com/matlab/matlab-agentic-toolkit">MATLAB Agentic Toolkit</a>, and <a href="https://github.com/matlab/simulink-agentic-toolkit">Simulink Agentic Toolkit</a>.</p></section>
</div></article>
